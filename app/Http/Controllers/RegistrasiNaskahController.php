<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\KodeKlasifikasi;
use App\Models\Sppd;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegistrasiNaskahController extends Controller
{
    /**
     * Menampilkan halaman Formulir Input Registrasi & Penomoran Otomatis Naskah Dinas (/registrasi-surat).
     */
    public function index(): View
    {
        $klasifikasiList = KodeKlasifikasi::query()->orderBy('id')->get();
        $pegawaiList = User::query()->where('is_active', true)->orderBy('nama_lengkap')->get();

        $nextUrutSuratKeluar = max(((int) SuratKeluar::query()->max('nomor_urut')) + 1, 2765);
        $nextUrutSppd = max(((int) Sppd::query()->max('nomor_urut')) + 1, 92);
        $nextUrutBeritaAcara = max(((int) BeritaAcara::query()->max('nomor_urut')) + 1, 29);

        $maxAgendaMasuk = (int) SuratMasuk::query()->selectRaw('MAX(CAST(nomor_urut_agenda AS UNSIGNED)) as max_no')->value('max_no');
        $nextUrutSuratMasuk = str_pad((string) max($maxAgendaMasuk + 1, 145), 4, '0', STR_PAD_LEFT);

        $revisiCount = SuratKeluar::where('status', 'revisi')->count()
            + Sppd::where('status', 'revisi')->count()
            + BeritaAcara::where('status', 'revisi')->count();

        $totalNaskahBerjalan = SuratKeluar::whereIn('status', ['draf', 'valid_kasubbag', 'valid_sekdin', 'revisi'])->count()
            + Sppd::whereIn('status', ['draf', 'valid_kasubbag', 'valid_sekdin', 'revisi'])->count()
            + BeritaAcara::whereIn('status', ['draf', 'valid_kasubbag', 'valid_sekdin', 'revisi'])->count();

        return view('registrasi-surat', [
            'klasifikasiList' => $klasifikasiList,
            'pegawaiList' => $pegawaiList,
            'nextUrutSuratKeluar' => $nextUrutSuratKeluar,
            'nextUrutSppd' => $nextUrutSppd,
            'nextUrutBeritaAcara' => $nextUrutBeritaAcara,
            'nextUrutSuratMasuk' => $nextUrutSuratMasuk,
            'revisiCount' => $revisiCount,
            'totalNaskahBerjalan' => $totalNaskahBerjalan,
        ]);
    }

    /**
     * Menampilkan halaman khusus Riwayat & Pantauan Naskah (/riwayat-naskah) untuk Staf Admin:
     * - Kartu ringkasan status real-time (draf, valid_kasubbag, valid_sekdin, revisi, ttd_kadin)
     * - Panel prioritas naskah revisi & modal Edit & Ajukan Ulang
     * - Filter kategori (Surat Keluar, SPPD, Berita Acara, Progres Surat Masuk), filter status, & pencarian
     * - Modal Timeline Riwayat log_verifikasi & Pratinjau Berkas Lampiran
     */
    public function riwayat(Request $request): View
    {
        $klasifikasiList = KodeKlasifikasi::query()->orderBy('id')->get();

        $suratKeluarList = SuratKeluar::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->orderByDesc('updated_at')
            ->get();

        $sppdList = Sppd::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->orderByDesc('updated_at')
            ->get();

        $beritaAcaraList = BeritaAcara::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->orderByDesc('updated_at')
            ->get();

        $suratMasukList = SuratMasuk::query()
            ->with(['kodeKlasifikasi', 'disposisi.kadin'])
            ->orderByDesc('tanggal_diterima')
            ->orderByDesc('id')
            ->get();

        $semuaNaskahKeluar = collect();

        foreach ($suratKeluarList as $sk) {
            $kodeBidang = $sk->kodeKlasifikasi->kode_bidang ?? '400';
            $namaBidang = $sk->kodeKlasifikasi->nama_bidang ?? 'Catatan Sipil';
            $filePath = $sk->file_konsep;

            $semuaNaskahKeluar->push([
                'key' => 'surat_keluar_' . $sk->id,
                'jenis' => 'surat_keluar',
                'jenis_label' => 'Surat Keluar',
                'jenis_badge_bg' => '#DBEAFE',
                'jenis_badge_color' => '#1D4ED8',
                'id' => $sk->id,
                'nomor' => $sk->nomor_surat,
                'nomor_urut' => $sk->nomor_urut,
                'kode_bidang' => $kodeBidang,
                'nama_bidang' => $namaBidang,
                'tanggal' => $sk->tanggal_dikeluarkan?->format('Y-m-d'),
                'tanggal_display' => $sk->tanggal_dikeluarkan?->format('d M Y') ?? '-',
                'tujuan' => $sk->alamat_tujuan,
                'sub_tujuan' => 'Sifat: ' . ($sk->sifat ?: 'Biasa') . ' • Lampiran: ' . ($sk->lampiran ?: '-'),
                'perihal' => $sk->perihal,
                'sifat' => $sk->sifat ?: 'Penting',
                'lampiran' => $sk->lampiran ?: '1 (Satu) Berkas',
                'nama_pegawai' => null,
                'nip_pegawai' => null,
                'jabatan_pegawai' => null,
                'tanggal_berangkat' => null,
                'tanggal_kembali' => null,
                'status' => $sk->status,
                'posisi_meja' => $this->resolvePosisiMeja($sk->status),
                'catatan_revisi' => $sk->catatan_revisi,
                'tte_token_uuid' => $sk->tte_token_uuid,
                'signed_at_display' => $sk->signed_at?->format('d M Y, H:i') . ($sk->signed_at ? ' WIB' : ''),
                'file_path' => $filePath,
                'file_url' => $filePath ? asset('storage/' . $filePath) : null,
                'file_name' => $filePath ? basename($filePath) : null,
                'pengaju_nama' => $sk->creator->nama_lengkap ?? 'Staf Admin Umpeg',
                'updated_at_display' => $sk->updated_at?->format('d M Y, H:i') . ' WIB',
                'priority_rank' => $this->resolveStatusPriority($sk->status),
                'updated_ts' => $sk->updated_at?->timestamp ?? 0,
                'logs' => $this->mapLogVerifikasi($sk->logVerifikasi),
            ]);
        }

        foreach ($sppdList as $sp) {
            $kodeBidang = $sp->kodeKlasifikasi->kode_bidang ?? '800';
            $namaBidang = $sp->kodeKlasifikasi->nama_bidang ?? 'Kepegawaian & Umum';

            $semuaNaskahKeluar->push([
                'key' => 'sppd_' . $sp->id,
                'jenis' => 'sppd',
                'jenis_label' => 'SPPD',
                'jenis_badge_bg' => '#FEF3C7',
                'jenis_badge_color' => '#B45309',
                'id' => $sp->id,
                'nomor' => $sp->nomor_sppd,
                'nomor_urut' => $sp->nomor_urut,
                'kode_bidang' => $kodeBidang,
                'nama_bidang' => $namaBidang,
                'tanggal' => $sp->tanggal_surat?->format('Y-m-d'),
                'tanggal_display' => $sp->tanggal_surat?->format('d M Y') ?? '-',
                'tujuan' => $sp->daerah_tujuan,
                'sub_tujuan' => 'Pegawai: ' . $sp->nama_pegawai . ' (' . ($sp->tanggal_berangkat?->format('d M') ?? '-') . ' s/d ' . ($sp->tanggal_kembali?->format('d M Y') ?? '-') . ')',
                'perihal' => $sp->urusan_perjalanan,
                'sifat' => 'Penting',
                'lampiran' => 'Surat Tugas & Visum SPPD',
                'nama_pegawai' => $sp->nama_pegawai,
                'nip_pegawai' => $sp->nip_pegawai,
                'jabatan_pegawai' => $sp->jabatan_pegawai,
                'tanggal_berangkat' => $sp->tanggal_berangkat?->format('Y-m-d'),
                'tanggal_kembali' => $sp->tanggal_kembali?->format('Y-m-d'),
                'status' => $sp->status,
                'posisi_meja' => $this->resolvePosisiMeja($sp->status),
                'catatan_revisi' => $sp->catatan_revisi,
                'tte_token_uuid' => $sp->tte_token_uuid,
                'signed_at_display' => $sp->signed_at?->format('d M Y, H:i') . ($sp->signed_at ? ' WIB' : ''),
                'file_path' => null,
                'file_url' => null,
                'file_name' => null,
                'pengaju_nama' => $sp->creator->nama_lengkap ?? 'Staf Admin Umpeg',
                'updated_at_display' => $sp->updated_at?->format('d M Y, H:i') . ' WIB',
                'priority_rank' => $this->resolveStatusPriority($sp->status),
                'updated_ts' => $sp->updated_at?->timestamp ?? 0,
                'logs' => $this->mapLogVerifikasi($sp->logVerifikasi),
            ]);
        }

        foreach ($beritaAcaraList as $ba) {
            $kodeBidang = $ba->kodeKlasifikasi->kode_bidang ?? '400';
            $namaBidang = $ba->kodeKlasifikasi->nama_bidang ?? 'Catatan Sipil';
            $filePath = $ba->file_dokumen;

            $semuaNaskahKeluar->push([
                'key' => 'berita_acara_' . $ba->id,
                'jenis' => 'berita_acara',
                'jenis_label' => 'Berita Acara',
                'jenis_badge_bg' => '#EDE9FE',
                'jenis_badge_color' => '#6D28D9',
                'id' => $ba->id,
                'nomor' => $ba->nomor_berita_acara,
                'nomor_urut' => $ba->nomor_urut,
                'kode_bidang' => $kodeBidang,
                'nama_bidang' => $namaBidang,
                'tanggal' => $ba->tanggal_berita_acara?->format('Y-m-d'),
                'tanggal_display' => $ba->tanggal_berita_acara?->format('d M Y') ?? '-',
                'tujuan' => $ba->pihak_kedua,
                'sub_tujuan' => 'Mitra / Pihak Kedua Berita Acara',
                'perihal' => $ba->perihal,
                'sifat' => 'Penting',
                'lampiran' => $filePath ? '1 (Satu) Berkas Dokumen BA' : '-',
                'nama_pegawai' => null,
                'nip_pegawai' => null,
                'jabatan_pegawai' => null,
                'tanggal_berangkat' => null,
                'tanggal_kembali' => null,
                'status' => $ba->status,
                'posisi_meja' => $this->resolvePosisiMeja($ba->status),
                'catatan_revisi' => $ba->catatan_revisi,
                'tte_token_uuid' => $ba->tte_token_uuid,
                'signed_at_display' => $ba->signed_at?->format('d M Y, H:i') . ($ba->signed_at ? ' WIB' : ''),
                'file_path' => $filePath,
                'file_url' => $filePath ? asset('storage/' . $filePath) : null,
                'file_name' => $filePath ? basename($filePath) : null,
                'pengaju_nama' => $ba->creator->nama_lengkap ?? 'Staf Admin Umpeg',
                'updated_at_display' => $ba->updated_at?->format('d M Y, H:i') . ' WIB',
                'priority_rank' => $this->resolveStatusPriority($ba->status),
                'updated_ts' => $ba->updated_at?->timestamp ?? 0,
                'logs' => $this->mapLogVerifikasi($ba->logVerifikasi),
            ]);
        }

        // Urutkan dengan prioritas status (revisi -> draf -> valid_kasubbag -> valid_sekdin -> ttd_kadin), lalu waktu terbaru
        $semuaNaskahKeluar = $semuaNaskahKeluar
            ->sort(function (array $a, array $b) {
                if ($a['priority_rank'] !== $b['priority_rank']) {
                    return $a['priority_rank'] <=> $b['priority_rank'];
                }

                return $b['updated_ts'] <=> $a['updated_ts'];
            })
            ->values();

        $naskahRevisi = $semuaNaskahKeluar->where('status', 'revisi')->values();

        $countRevisi = $naskahRevisi->count();
        $countDraf = $semuaNaskahKeluar->where('status', 'draf')->count();
        $countValidKasubbag = $semuaNaskahKeluar->where('status', 'valid_kasubbag')->count();
        $countValidSekdin = $semuaNaskahKeluar->where('status', 'valid_sekdin')->count();
        $countTtdKadin = $semuaNaskahKeluar->where('status', 'ttd_kadin')->count();

        $countSuratMasuk = $suratMasukList->count();
        $countSuratMasukBelumNaik = $suratMasukList->where('status_kenaikan', 'belum_naik')->count();

        return view('riwayat-naskah', [
            'klasifikasiList' => $klasifikasiList,
            'semuaNaskahKeluar' => $semuaNaskahKeluar,
            'naskahRevisi' => $naskahRevisi,
            'suratMasukList' => $suratMasukList,
            'countRevisi' => $countRevisi,
            'countDraf' => $countDraf,
            'countValidKasubbag' => $countValidKasubbag,
            'countValidSekdin' => $countValidSekdin,
            'countTtdKadin' => $countTtdKadin,
            'countSuratMasuk' => $countSuratMasuk,
            'countSuratMasukBelumNaik' => $countSuratMasukBelumNaik,
            'initialStatusFilter' => (string) $request->query('status', 'all'),
            'initialKategoriFilter' => (string) $request->query('kategori', 'all_keluar'),
            'initialOpenEditKey' => (string) $request->query('open_edit', ''),
        ]);
    }

    /**
     * Menyimpan konsep Surat Keluar baru & mengajukan ke Verifikasi Tahap 1 (Kasubbag Umpeg).
     */
    public function storeSuratKeluar(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'nomor_urut' => ['required', 'integer', 'min:1'],
                'kode_bidang' => ['required', 'string', 'exists:kode_klasifikasi,kode_bidang'],
                'tanggal_dikeluarkan' => ['required', 'date'],
                'alamat_tujuan' => ['required', 'string', 'max:255'],
                'perihal' => ['required', 'string'],
                'sifat' => ['nullable', 'string', 'max:20'],
                'lampiran' => ['nullable', 'string', 'max:100'],
                'file_konsep' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            ],
            [
                'nomor_urut.required' => 'Nomor urut agenda surat keluar wajib diisi.',
                'kode_bidang.required' => 'Kode klasifikasi bidang wajib dipilih.',
                'tanggal_dikeluarkan.required' => 'Tanggal dikeluarkan surat wajib diisi.',
                'alamat_tujuan.required' => 'Alamat/instansi tujuan surat wajib diisi.',
                'perihal.required' => 'Perihal / isi ringkas surat keluar wajib diisi.',
                'file_konsep.mimes' => 'Berkas konsep surat harus berformat PDF, DOC, atau DOCX.',
                'file_konsep.max' => 'Ukuran berkas konsep surat maksimal 5 MB.',
            ]
        );

        $klasifikasi = KodeKlasifikasi::query()
            ->where('kode_bidang', $validated['kode_bidang'])
            ->firstOrFail();

        $tahun = (int) date('Y', strtotime($validated['tanggal_dikeluarkan']));
        $nomorSurat = SuratKeluar::formatNomorOtomatis($klasifikasi->kode_bidang, (int) $validated['nomor_urut'], $tahun);

        if (SuratKeluar::query()->where('nomor_surat', $nomorSurat)->exists()) {
            return back()
                ->withErrors(['nomor_urut' => 'Nomor surat ' . $nomorSurat . ' sudah terdaftar di Buku Agenda. Silakan gunakan nomor urut berikutnya.'])
                ->withInput();
        }

        $filePath = null;
        if ($request->hasFile('file_konsep')) {
            $filePath = $request->file('file_konsep')->store('naskah/surat-keluar', 'public');
        }

        $suratKeluar = SuratKeluar::create([
            'nomor_urut' => (int) $validated['nomor_urut'],
            'kode_klasifikasi_id' => $klasifikasi->id,
            'tahun' => $tahun,
            'nomor_surat' => $nomorSurat,
            'tanggal_dikeluarkan' => $validated['tanggal_dikeluarkan'],
            'alamat_tujuan' => trim($validated['alamat_tujuan']),
            'perihal' => trim($validated['perihal']),
            'sifat' => $validated['sifat'] ?: 'Penting',
            'lampiran' => $validated['lampiran'] ? trim($validated['lampiran']) : '1 (Satu) Berkas',
            'file_konsep' => $filePath,
            'status' => 'draf',
            'catatan_revisi' => null,
            'created_by' => Auth::id(),
        ]);

        $suratKeluar->logVerifikasi()->create([
            'tahap_verifikasi' => 'staf_admin',
            'status_aksi' => 'diajukan',
            'verifikator_id' => Auth::id(),
            'catatan' => 'Konsep Surat Keluar ' . $nomorSurat . ' berhasil diregistrasi dan diajukan ke Kasubbag Umpeg (Verifikator Tahap 1).',
            'waktu_verifikasi' => now(),
        ]);

        return redirect()
            ->route('registrasi.surat')
            ->with('status', 'Surat Keluar (' . $nomorSurat . ') berhasil disimpan dan diajukan ke antrean Verifikasi Tahap 1 (Kasubbag Umpeg).');
    }

    /**
     * Menyimpan konsep SPPD baru & mengajukan ke Verifikasi Tahap 1 (Kasubbag Umpeg).
     */
    public function storeSppd(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'nomor_urut' => ['required', 'integer', 'min:1'],
                'nomor_sppd' => ['required', 'string', 'max:100', 'unique:sppd,nomor_sppd'],
                'kode_bidang' => ['nullable', 'string', 'exists:kode_klasifikasi,kode_bidang'],
                'tanggal_surat' => ['required', 'date'],
                'nama_pegawai' => ['required', 'string', 'max:255'],
                'nip_pegawai' => ['nullable', 'string', 'max:18'],
                'jabatan_pegawai' => ['required', 'string', 'max:255'],
                'tanggal_berangkat' => ['required', 'date'],
                'tanggal_kembali' => ['required', 'date', 'after_or_equal:tanggal_berangkat'],
                'daerah_tujuan' => ['required', 'string', 'max:255'],
                'urusan_perjalanan' => ['required', 'string'],
            ],
            [
                'nomor_sppd.unique' => 'Nomor SPPD tersebut sudah terdaftar di Buku Agenda.',
                'nama_pegawai.required' => 'Nama pegawai yang diperintahkan wajib diisi.',
                'jabatan_pegawai.required' => 'Jabatan pegawai yang diperintahkan wajib diisi.',
                'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh lebih awal dari tanggal berangkat.',
                'daerah_tujuan.required' => 'Daerah/instansi tujuan perjalanan dinas wajib diisi.',
                'urusan_perjalanan.required' => 'Urusan / maksud perjalanan dinas wajib diisi.',
            ]
        );

        $klasifikasi = KodeKlasifikasi::query()
            ->where('kode_bidang', $validated['kode_bidang'] ?? '800')
            ->first() ?? KodeKlasifikasi::query()->firstOrFail();

        $pegawaiUser = null;
        if (! empty($validated['nip_pegawai'])) {
            $cleanNip = preg_replace('/\s+/', '', $validated['nip_pegawai']);
            $pegawaiUser = User::query()->where('nip', $cleanNip)->first();
        }

        $sppd = Sppd::create([
            'nomor_urut' => (int) $validated['nomor_urut'],
            'kode_klasifikasi_id' => $klasifikasi->id,
            'nomor_sppd' => trim($validated['nomor_sppd']),
            'tanggal_surat' => $validated['tanggal_surat'],
            'pegawai_id' => $pegawaiUser?->id,
            'nama_pegawai' => trim($validated['nama_pegawai']),
            'nip_pegawai' => ! empty($validated['nip_pegawai']) ? substr(preg_replace('/\s+/', '', $validated['nip_pegawai']), 0, 18) : null,
            'jabatan_pegawai' => trim($validated['jabatan_pegawai']),
            'tanggal_berangkat' => $validated['tanggal_berangkat'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'daerah_tujuan' => trim($validated['daerah_tujuan']),
            'urusan_perjalanan' => trim($validated['urusan_perjalanan']),
            'status' => 'draf',
            'catatan_revisi' => null,
            'created_by' => Auth::id(),
        ]);

        $sppd->logVerifikasi()->create([
            'tahap_verifikasi' => 'staf_admin',
            'status_aksi' => 'diajukan',
            'verifikator_id' => Auth::id(),
            'catatan' => 'Konsep SPPD ' . $sppd->nomor_sppd . ' atas nama ' . $sppd->nama_pegawai . ' diajukan ke Kasubbag Umpeg.',
            'waktu_verifikasi' => now(),
        ]);

        return redirect()
            ->route('registrasi.surat')
            ->with('status', 'SPPD (' . $sppd->nomor_sppd . ') atas nama ' . $sppd->nama_pegawai . ' berhasil disimpan dan diajukan ke Kasubbag Umpeg.');
    }

    /**
     * Menyimpan konsep Berita Acara baru & mengajukan ke Verifikasi Tahap 1 (Kasubbag Umpeg).
     */
    public function storeBeritaAcara(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'nomor_urut' => ['required', 'integer', 'min:1'],
                'nomor_berita_acara' => ['required', 'string', 'max:100', 'unique:berita_acara,nomor_berita_acara'],
                'kode_bidang' => ['nullable', 'string', 'exists:kode_klasifikasi,kode_bidang'],
                'tanggal_berita_acara' => ['required', 'date'],
                'pihak_kedua' => ['required', 'string', 'max:255'],
                'perihal' => ['required', 'string'],
                'file_dokumen' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            ],
            [
                'nomor_berita_acara.unique' => 'Nomor Berita Acara tersebut sudah terdaftar.',
                'pihak_kedua.required' => 'Pihak Kedua / Instansi Mitra wajib diisi.',
                'perihal.required' => 'Pokok / Perihal Berita Acara wajib diisi.',
            ]
        );

        $klasifikasi = KodeKlasifikasi::query()
            ->where('kode_bidang', $validated['kode_bidang'] ?? '400')
            ->first() ?? KodeKlasifikasi::query()->firstOrFail();

        $filePath = null;
        if ($request->hasFile('file_dokumen')) {
            $filePath = $request->file('file_dokumen')->store('naskah/berita-acara', 'public');
        }

        $beritaAcara = BeritaAcara::create([
            'nomor_urut' => (int) $validated['nomor_urut'],
            'kode_klasifikasi_id' => $klasifikasi->id,
            'nomor_berita_acara' => trim($validated['nomor_berita_acara']),
            'tanggal_berita_acara' => $validated['tanggal_berita_acara'],
            'pihak_kedua' => trim($validated['pihak_kedua']),
            'perihal' => trim($validated['perihal']),
            'file_dokumen' => $filePath,
            'status' => 'draf',
            'catatan_revisi' => null,
            'created_by' => Auth::id(),
        ]);

        $beritaAcara->logVerifikasi()->create([
            'tahap_verifikasi' => 'staf_admin',
            'status_aksi' => 'diajukan',
            'verifikator_id' => Auth::id(),
            'catatan' => 'Konsep Berita Acara ' . $beritaAcara->nomor_berita_acara . ' diajukan ke Kasubbag Umpeg.',
            'waktu_verifikasi' => now(),
        ]);

        return redirect()
            ->route('registrasi.surat')
            ->with('status', 'Berita Acara (' . $beritaAcara->nomor_berita_acara . ') berhasil disimpan dan diajukan ke Kasubbag Umpeg.');
    }

    /**
     * Menyimpan registrasi agenda Surat Masuk baru oleh Staf Admin.
     */
    public function storeSuratMasuk(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'nomor_urut_agenda' => ['required', 'string', 'max:15', 'unique:surat_masuk,nomor_urut_agenda'],
                'tanggal_diterima' => ['required', 'date'],
                'pengirim' => ['required', 'string', 'max:255'],
                'tanggal_surat' => ['required', 'date'],
                'nomor_surat' => ['required', 'string', 'max:120'],
                'perihal' => ['required', 'string'],
                'sifat_surat' => ['required', 'string', 'max:20'],
                'kode_bidang' => ['required', 'string', 'exists:kode_klasifikasi,kode_bidang'],
                'langsung_naik_ajudan' => ['nullable', 'boolean'],
                'file_lampiran' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            ],
            [
                'nomor_urut_agenda.unique' => 'Nomor urut agenda surat masuk tersebut sudah digunakan.',
                'pengirim.required' => 'Instansi pengirim surat masuk wajib diisi.',
                'nomor_surat.required' => 'Nomor surat asal wajib diisi.',
                'perihal.required' => 'Perihal surat masuk wajib diisi.',
            ]
        );

        $klasifikasi = KodeKlasifikasi::query()
            ->where('kode_bidang', $validated['kode_bidang'])
            ->firstOrFail();

        $filePath = null;
        if ($request->hasFile('file_lampiran')) {
            $filePath = $request->file('file_lampiran')->store('naskah/surat-masuk', 'public');
        }

        $naikAjudan = $request->boolean('langsung_naik_ajudan', true);
        /** @var User $authUser */
        $authUser = Auth::user();

        $suratMasuk = SuratMasuk::create([
            'nomor_urut_agenda' => trim($validated['nomor_urut_agenda']),
            'tanggal_diterima' => $validated['tanggal_diterima'],
            'pengirim' => trim($validated['pengirim']),
            'tanggal_surat' => $validated['tanggal_surat'],
            'nomor_surat' => trim($validated['nomor_surat']),
            'perihal' => trim($validated['perihal']),
            'sifat_surat' => $validated['sifat_surat'],
            'kode_klasifikasi_id' => $klasifikasi->id,
            'file_lampiran' => $filePath,
            'tanggal_naik_kadin' => $naikAjudan ? now() : null,
            'ajudan_id' => $naikAjudan ? $authUser->id : null,
            'nama_ajudan_penerima' => $naikAjudan ? $authUser->nama_lengkap : null,
            'status_kenaikan' => $naikAjudan ? 'diterima_ajudan' : 'belum_naik',
            'status' => $naikAjudan ? 'diproses' : 'baru',
            'created_by' => $authUser->id,
        ]);

        return redirect()
            ->route('registrasi.surat')
            ->with('status', 'Agenda Surat Masuk #' . $suratMasuk->nomor_urut_agenda . ' dari ' . $suratMasuk->pengirim . ' berhasil dicatat ke Buku Agenda.');
    }

    /**
     * Memperbarui & mengajukan ulang naskah yang berstatus 'revisi' atau 'draf' (Surat Keluar, SPPD, Berita Acara).
     */
    public function updateNaskah(Request $request, string $jenis, int $id): RedirectResponse
    {
        if (! in_array($jenis, ['surat_keluar', 'sppd', 'berita_acara'], true)) {
            return back()->with('error', 'Jenis naskah tidak dikenali.');
        }

        if ($jenis === 'surat_keluar') {
            $naskah = SuratKeluar::query()->findOrFail($id);

            if (! in_array($naskah->status, ['revisi', 'draf'], true)) {
                return back()->with('error', 'Naskah sudah berada pada tahap verifikasi lanjut dan tidak dapat diubah.');
            }

            $validated = $request->validate([
                'kode_bidang' => ['required', 'string', 'exists:kode_klasifikasi,kode_bidang'],
                'nomor_urut' => ['required', 'integer', 'min:1'],
                'tanggal_dikeluarkan' => ['required', 'date'],
                'alamat_tujuan' => ['required', 'string', 'max:255'],
                'perihal' => ['required', 'string'],
                'sifat' => ['nullable', 'string', 'max:20'],
                'lampiran' => ['nullable', 'string', 'max:100'],
                'catatan_perbaikan' => ['nullable', 'string', 'max:500'],
                'file_konsep' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            ]);

            $klasifikasi = KodeKlasifikasi::query()->where('kode_bidang', $validated['kode_bidang'])->firstOrFail();
            $tahun = (int) date('Y', strtotime($validated['tanggal_dikeluarkan']));
            $nomorSurat = SuratKeluar::formatNomorOtomatis($klasifikasi->kode_bidang, (int) $validated['nomor_urut'], $tahun);

            $duplicate = SuratKeluar::query()
                ->where('nomor_surat', $nomorSurat)
                ->where('id', '!=', $naskah->id)
                ->exists();

            if ($duplicate) {
                return back()->with('error', 'Nomor surat ' . $nomorSurat . ' sudah digunakan oleh naskah lain.');
            }

            $updateData = [
                'nomor_urut' => (int) $validated['nomor_urut'],
                'kode_klasifikasi_id' => $klasifikasi->id,
                'tahun' => $tahun,
                'nomor_surat' => $nomorSurat,
                'tanggal_dikeluarkan' => $validated['tanggal_dikeluarkan'],
                'alamat_tujuan' => trim($validated['alamat_tujuan']),
                'perihal' => trim($validated['perihal']),
                'sifat' => $validated['sifat'] ?: $naskah->sifat,
                'lampiran' => $validated['lampiran'] ? trim($validated['lampiran']) : $naskah->lampiran,
                'status' => 'draf',
                'catatan_revisi' => null,
            ];

            if ($request->hasFile('file_konsep')) {
                $updateData['file_konsep'] = $request->file('file_konsep')->store('naskah/surat-keluar', 'public');
            }

            $naskah->update($updateData);

            $naskah->logVerifikasi()->create([
                'tahap_verifikasi' => 'staf_admin',
                'status_aksi' => 'diajukan',
                'verifikator_id' => Auth::id(),
                'catatan' => 'Revisi selesai diperbaiki & diajukan ulang: ' . ($validated['catatan_perbaikan'] ?: 'Redaksi dan kelengkapan naskah telah disesuaikan.'),
                'waktu_verifikasi' => now(),
            ]);

            return redirect()
                ->route('riwayat.naskah')
                ->with('status', 'Perbaikan Surat Keluar (' . $nomorSurat . ') berhasil disimpan dan diajukan kembali ke Kasubbag Umpeg.');
        }

        if ($jenis === 'sppd') {
            $naskah = Sppd::query()->findOrFail($id);

            if (! in_array($naskah->status, ['revisi', 'draf'], true)) {
                return back()->with('error', 'SPPD sudah berada pada tahap verifikasi lanjut dan tidak dapat diubah.');
            }

            $validated = $request->validate([
                'nomor_sppd' => ['required', 'string', 'max:100', Rule::unique('sppd', 'nomor_sppd')->ignore($naskah->id)],
                'tanggal_surat' => ['required', 'date'],
                'nama_pegawai' => ['required', 'string', 'max:255'],
                'nip_pegawai' => ['nullable', 'string', 'max:18'],
                'jabatan_pegawai' => ['required', 'string', 'max:255'],
                'tanggal_berangkat' => ['required', 'date'],
                'tanggal_kembali' => ['required', 'date', 'after_or_equal:tanggal_berangkat'],
                'daerah_tujuan' => ['required', 'string', 'max:255'],
                'urusan_perjalanan' => ['required', 'string'],
                'catatan_perbaikan' => ['nullable', 'string', 'max:500'],
            ]);

            $naskah->update([
                'nomor_sppd' => trim($validated['nomor_sppd']),
                'tanggal_surat' => $validated['tanggal_surat'],
                'nama_pegawai' => trim($validated['nama_pegawai']),
                'nip_pegawai' => ! empty($validated['nip_pegawai']) ? substr(preg_replace('/\s+/', '', $validated['nip_pegawai']), 0, 18) : null,
                'jabatan_pegawai' => trim($validated['jabatan_pegawai']),
                'tanggal_berangkat' => $validated['tanggal_berangkat'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'daerah_tujuan' => trim($validated['daerah_tujuan']),
                'urusan_perjalanan' => trim($validated['urusan_perjalanan']),
                'status' => 'draf',
                'catatan_revisi' => null,
            ]);

            $naskah->logVerifikasi()->create([
                'tahap_verifikasi' => 'staf_admin',
                'status_aksi' => 'diajukan',
                'verifikator_id' => Auth::id(),
                'catatan' => 'Revisi SPPD selesai diperbaiki & diajukan ulang: ' . ($validated['catatan_perbaikan'] ?: 'Data perjalanan dinas telah disesuaikan.'),
                'waktu_verifikasi' => now(),
            ]);

            return redirect()
                ->route('riwayat.naskah')
                ->with('status', 'Perbaikan SPPD (' . $naskah->nomor_sppd . ') berhasil disimpan dan diajukan kembali ke Kasubbag Umpeg.');
        }

        // berita_acara
        $naskah = BeritaAcara::query()->findOrFail($id);

        if (! in_array($naskah->status, ['revisi', 'draf'], true)) {
            return back()->with('error', 'Berita Acara sudah berada pada tahap verifikasi lanjut dan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'nomor_berita_acara' => ['required', 'string', 'max:100', Rule::unique('berita_acara', 'nomor_berita_acara')->ignore($naskah->id)],
            'tanggal_berita_acara' => ['required', 'date'],
            'pihak_kedua' => ['required', 'string', 'max:255'],
            'perihal' => ['required', 'string'],
            'catatan_perbaikan' => ['nullable', 'string', 'max:500'],
            'file_dokumen' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $updateData = [
            'nomor_berita_acara' => trim($validated['nomor_berita_acara']),
            'tanggal_berita_acara' => $validated['tanggal_berita_acara'],
            'pihak_kedua' => trim($validated['pihak_kedua']),
            'perihal' => trim($validated['perihal']),
            'status' => 'draf',
            'catatan_revisi' => null,
        ];

        if ($request->hasFile('file_dokumen')) {
            $updateData['file_dokumen'] = $request->file('file_dokumen')->store('naskah/berita-acara', 'public');
        }

        $naskah->update($updateData);

        $naskah->logVerifikasi()->create([
            'tahap_verifikasi' => 'staf_admin',
            'status_aksi' => 'diajukan',
            'verifikator_id' => Auth::id(),
            'catatan' => 'Revisi Berita Acara selesai diperbaiki & diajukan ulang: ' . ($validated['catatan_perbaikan'] ?: 'Pokok berita acara telah disesuaikan.'),
            'waktu_verifikasi' => now(),
        ]);

        return redirect()
            ->route('riwayat.naskah')
            ->with('status', 'Perbaikan Berita Acara (' . $naskah->nomor_berita_acara . ') berhasil disimpan dan diajukan kembali ke Kasubbag Umpeg.');
    }

    /**
     * Menaikkan Surat Masuk berstatus 'baru' ke Ajudan Kepala Dinas.
     */
    public function naikkanSuratMasuk(SuratMasuk $suratMasuk): RedirectResponse
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        $suratMasuk->update([
            'tanggal_naik_kadin' => now(),
            'ajudan_id' => $authUser->id,
            'nama_ajudan_penerima' => $authUser->nama_lengkap,
            'status_kenaikan' => 'diterima_ajudan',
            'status' => $suratMasuk->status === 'selesai' ? 'selesai' : 'diproses',
        ]);

        return back()->with(
            'status',
            'Surat Masuk #' . $suratMasuk->nomor_urut_agenda . ' (' . $suratMasuk->nomor_surat . ') telah diserahkan ke Ajudan Kepala Dinas untuk proses disposisi.'
        );
    }

    private function resolveStatusPriority(string $status): int
    {
        return match ($status) {
            'revisi' => 1,
            'draf' => 2,
            'valid_kasubbag' => 3,
            'valid_sekdin' => 4,
            'ttd_kadin' => 5,
            default => 6,
        };
    }

    private function resolvePosisiMeja(string $status): string
    {
        return match ($status) {
            'revisi' => 'Meja Staf Admin Umpeg (Perlu Perbaikan Revisi)',
            'draf' => 'Meja Kasubbag Umpeg (Pemeriksaan Tahap 1)',
            'valid_kasubbag' => 'Meja Sekretaris Dinas (Paraf Koordinasi Tahap 2)',
            'valid_sekdin' => 'Meja Kepala Dinas (Antrean Otorisasi TTE QR Code)',
            'ttd_kadin' => 'Selesai & Sah (Tanda Tangan Elektronik QR Code Terbit)',
            default => '-',
        };
    }

    private function mapLogVerifikasi(Collection $logs): array
    {
        return $logs->map(function ($log) {
            $tahapLabel = match ($log->tahap_verifikasi) {
                'staf_admin' => 'Staf Admin Umpeg (Pengaju Konsep)',
                'kasubbag_umpeg' => 'Kasubbag Umpeg (Verifikasi Tahap 1)',
                'sekretaris_dinas' => 'Sekretaris Dinas (Paraf Tahap 2)',
                'kepala_dinas' => 'Kepala Dinas (Otorisasi TTE QR Code)',
                default => $log->tahap_verifikasi,
            };

            $aksiLabel = match ($log->status_aksi) {
                'diajukan' => 'Diajukan',
                'valid_kasubbag' => 'Disetujui Kasubbag',
                'valid_sekdin' => 'Diparaf Sekdin',
                'ttd_kadin' => 'Disahkan TTE Kadin',
                'revisi' => 'Dikembalikan (Revisi)',
                default => $log->status_aksi,
            };

            return [
                'tahap_verifikasi' => $log->tahap_verifikasi,
                'tahap_label' => $tahapLabel,
                'status_aksi' => $log->status_aksi,
                'aksi_label' => $aksiLabel,
                'verifikator_nama' => $log->verifikator->nama_lengkap ?? 'Pejabat / Sistem',
                'verifikator_jabatan' => $log->verifikator->jabatan ?? '-',
                'catatan' => $log->catatan,
                'checklist_pemeriksaan' => $log->checklist_pemeriksaan,
                'waktu' => $log->waktu_verifikasi ? $log->waktu_verifikasi->format('d M Y, H:i') . ' WIB' : '-',
            ];
        })->values()->all();
    }
}
