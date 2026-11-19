<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\Sppd;
use App\Models\SuratKeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VerifikasiHierarkiController extends Controller
{
    /**
     * Menampilkan meja kerja Verifikasi Berjenjang yang dikunci sesuai role pejabat yang login:
     * - kasubbag: Hanya Tahap 1 (naskah berstatus 'draf')
     * - sekdin: Hanya Tahap 2 (naskah berstatus 'valid_kasubbag')
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $userRole = $user->role;

        // Kunci status antrean sesuai role yang login
        $targetStatus = $userRole === 'sekdin' ? 'valid_kasubbag' : 'draf';

        // Hitung statistik metrik seluruh jenis naskah (Surat Keluar, SPPD, Berita Acara)
        $countTahap1 = SuratKeluar::where('status', 'draf')->count()
            + Sppd::where('status', 'draf')->count()
            + BeritaAcara::where('status', 'draf')->count();

        $countTahap2 = SuratKeluar::where('status', 'valid_kasubbag')->count()
            + Sppd::where('status', 'valid_kasubbag')->count()
            + BeritaAcara::where('status', 'valid_kasubbag')->count();

        $countRevisi = SuratKeluar::where('status', 'revisi')->count()
            + Sppd::where('status', 'revisi')->count()
            + BeritaAcara::where('status', 'revisi')->count();

        $countMenungguTteKadin = SuratKeluar::where('status', 'valid_sekdin')->count()
            + Sppd::where('status', 'valid_sekdin')->count()
            + BeritaAcara::where('status', 'valid_sekdin')->count();

        $countSelesaiTteKadin = SuratKeluar::where('status', 'ttd_kadin')->count()
            + Sppd::where('status', 'ttd_kadin')->count()
            + BeritaAcara::where('status', 'ttd_kadin')->count();

        $countDiteruskanKadin = $countMenungguTteKadin + $countSelesaiTteKadin;

        // Ambil antrean naskah aktif khusus untuk tahap verifikator yang sedang login
        $antreanKonsep = $this->collectNaskahByStatus($targetStatus);

        // Pilih konsep aktif untuk ditampilkan pada lembar pratinjau A4 & form keputusan
        $selectedJenis = $request->query('jenis');
        $selectedId = $request->query('id') ? (int) $request->query('id') : null;

        $activeKonsep = null;
        if ($selectedJenis && $selectedId) {
            $activeKonsep = $antreanKonsep->first(function (array $item) use ($selectedJenis, $selectedId) {
                return $item['jenis'] === $selectedJenis && $item['id'] === $selectedId;
            });
        }

        if (! $activeKonsep) {
            $activeKonsep = $antreanKonsep->first();
        }

        return view('verifikasi-hierarki', [
            'targetStatus' => $targetStatus,
            'countTahap1' => $countTahap1,
            'countTahap2' => $countTahap2,
            'countRevisi' => $countRevisi,
            'countMenungguTteKadin' => $countMenungguTteKadin,
            'countSelesaiTteKadin' => $countSelesaiTteKadin,
            'countDiteruskanKadin' => $countDiteruskanKadin,
            'antreanKonsep' => $antreanKonsep,
            'activeKonsep' => $activeKonsep,
        ]);
    }

    /**
     * Menyetujui / memaraf naskah dinas dan meneruskan ke jenjang berikutnya:
     * - kasubbag: 'draf' -> 'valid_kasubbag' (log: tahap_verifikasi = 'kasubbag_umpeg', status_aksi = 'valid_kasubbag')
     * - sekdin: 'valid_kasubbag' -> 'valid_sekdin' (log: tahap_verifikasi = 'sekretaris_dinas', status_aksi = 'valid_sekdin')
     */
    public function approve(Request $request, string $jenis, int $id): RedirectResponse
    {
        $user = Auth::user();
        $naskah = $this->resolveNaskahModel($jenis, $id);

        if (! $naskah) {
            return back()->with('error', 'Jenis atau data naskah dinas tidak ditemukan.');
        }

        // Validasi penguncian tahap berdasarkan role
        if ($user->role === 'kasubbag') {
            if ($naskah->status !== 'draf') {
                return redirect()->route('verifikasi.hierarki')
                    ->with('error', 'Otoritas Terkunci: Kasubbag Umpeg hanya dapat memverifikasi naskah Tahap 1 yang berstatus Draf.');
            }
            $newStatus = 'valid_kasubbag';
            $tahapVerifikasi = 'kasubbag_umpeg';
            $statusAksi = 'valid_kasubbag';
            $defaultCatatan = 'Kode klasifikasi, kelengkapan lampiran, dan redaksi naskah telah diperiksa serta disetujui oleh Kasubbag Umpeg. Diteruskan ke Sekretaris Dinas.';
        } elseif ($user->role === 'sekdin') {
            if ($naskah->status !== 'valid_kasubbag') {
                return redirect()->route('verifikasi.hierarki')
                    ->with('error', 'Otoritas Terkunci: Sekretaris Dinas hanya dapat memaraf naskah Tahap 2 yang telah disetujui Kasubbag Umpeg.');
            }
            $newStatus = 'valid_sekdin';
            $tahapVerifikasi = 'sekretaris_dinas';
            $statusAksi = 'valid_sekdin';
            $defaultCatatan = 'Telah diparaf koordinasi oleh Sekretaris Dinas dan diteruskan ke Kepala Dinas untuk otorisasi TTE QR Code.';
        } else {
            abort(403, 'Anda tidak memiliki hak akses verifikasi berjenjang.');
        }

        $validated = $request->validate(
            [
                'catatan' => ['nullable', 'string', 'max:1000'],
                'checklist' => ['required', 'array'],
                'checklist.kode_klasifikasi' => ['accepted'],
                'checklist.kelengkapan_lampiran' => ['accepted'],
                'checklist.ketepatan_redaksi' => ['accepted'],
            ],
            [
                'checklist.required' => 'Seluruh parameter Checklist Standar Tata Naskah Dinas wajib dicentang sebelum menyetujui naskah.',
                'checklist.kode_klasifikasi.accepted' => 'Checklist Kesesuaian Kode Klasifikasi Bidang & Nomor Urut wajib dicentang.',
                'checklist.kelengkapan_lampiran.accepted' => 'Checklist Kelengkapan Berkas Lampiran Pendukung wajib dicentang.',
                'checklist.ketepatan_redaksi.accepted' => 'Checklist Ketepatan Redaksi & Tujuan Naskah wajib dicentang.',
            ]
        );

        $checklistData = $this->extractChecklist($request);
        $catatanFinal = trim((string) ($validated['catatan'] ?? '')) ?: $defaultCatatan;
        $nomorNaskah = $this->getNomorNaskah($naskah, $jenis);

        DB::transaction(function () use ($naskah, $newStatus, $tahapVerifikasi, $statusAksi, $user, $catatanFinal, $checklistData) {
            $naskah->update([
                'status' => $newStatus,
                'catatan_revisi' => null,
            ]);

            $naskah->logVerifikasi()->create([
                'tahap_verifikasi' => $tahapVerifikasi,
                'status_aksi' => $statusAksi,
                'verifikator_id' => $user->id,
                'catatan' => $catatanFinal,
                'checklist_pemeriksaan' => $checklistData,
                'waktu_verifikasi' => now(),
            ]);
        });

        $tujuanBerikutnya = $user->role === 'sekdin'
            ? 'Antrean Otorisasi TTE Kepala Dinas (status: valid_sekdin)'
            : 'Antrean Paraf Tahap 2 Sekretaris Dinas (status: valid_kasubbag)';

        return redirect()->route('verifikasi.hierarki')
            ->with('status', "Naskah {$nomorNaskah} berhasil divalidasi dan diteruskan ke {$tujuanBerikutnya}.");
    }

    /**
     * Mengembalikan konsep naskah dinas ke Staf Admin untuk diperbaiki (status = 'revisi' + catatan_revisi).
     */
    public function revisi(Request $request, string $jenis, int $id): RedirectResponse
    {
        $user = Auth::user();
        $naskah = $this->resolveNaskahModel($jenis, $id);

        if (! $naskah) {
            return back()->with('error', 'Jenis atau data naskah dinas tidak ditemukan.');
        }

        // Validasi penguncian tahap berdasarkan role
        if ($user->role === 'kasubbag') {
            if ($naskah->status !== 'draf') {
                return redirect()->route('verifikasi.hierarki')
                    ->with('error', 'Otoritas Terkunci: Kasubbag Umpeg hanya dapat mengembalikan naskah Tahap 1 yang berstatus Draf.');
            }
            $tahapVerifikasi = 'kasubbag_umpeg';
        } elseif ($user->role === 'sekdin') {
            if ($naskah->status !== 'valid_kasubbag') {
                return redirect()->route('verifikasi.hierarki')
                    ->with('error', 'Otoritas Terkunci: Sekretaris Dinas hanya dapat mengembalikan naskah Tahap 2 yang berstatus Valid Kasubbag.');
            }
            $tahapVerifikasi = 'sekretaris_dinas';
        } else {
            abort(403, 'Anda tidak memiliki hak akses verifikasi berjenjang.');
        }

        $validated = $request->validate(
            [
                'catatan_revisi' => ['required', 'string', 'min:5', 'max:1000'],
                'checklist' => ['nullable', 'array'],
            ],
            [
                'catatan_revisi.required' => 'Catatan instruksi revisi wajib diisi agar Staf Admin mengetahui bagian naskah yang harus diperbaiki.',
                'catatan_revisi.min' => 'Catatan instruksi revisi minimal terdiri dari 5 karakter.',
            ]
        );

        $checklistData = $this->extractChecklist($request);
        $catatanRevisi = trim($validated['catatan_revisi']);
        $nomorNaskah = $this->getNomorNaskah($naskah, $jenis);

        DB::transaction(function () use ($naskah, $tahapVerifikasi, $user, $catatanRevisi, $checklistData) {
            $naskah->update([
                'status' => 'revisi',
                'catatan_revisi' => $catatanRevisi,
            ]);

            $naskah->logVerifikasi()->create([
                'tahap_verifikasi' => $tahapVerifikasi,
                'status_aksi' => 'revisi',
                'verifikator_id' => $user->id,
                'catatan' => $catatanRevisi,
                'checklist_pemeriksaan' => $checklistData,
                'waktu_verifikasi' => now(),
            ]);
        });

        return redirect()->route('verifikasi.hierarki')
            ->with('status', "Naskah {$nomorNaskah} telah dikembalikan ke Staf Admin dengan status Revisi beserta catatan koreksi.");
    }

    /**
     * Mengambil dan menormalisasi seluruh jenis naskah (SuratKeluar, Sppd, BeritaAcara) berdasarkan status.
     */
    private function collectNaskahByStatus(string $status): Collection
    {
        $items = collect();

        $suratKeluarList = SuratKeluar::query()
            ->with(['kodeKlasifikasi', 'creator', 'logVerifikasi.verifikator'])
            ->where('status', $status)
            ->orderByDesc('updated_at')
            ->get();

        foreach ($suratKeluarList as $sk) {
            $items->push($this->normalizeSuratKeluar($sk));
        }

        $sppdList = Sppd::query()
            ->with(['kodeKlasifikasi', 'creator', 'logVerifikasi.verifikator'])
            ->where('status', $status)
            ->orderByDesc('updated_at')
            ->get();

        foreach ($sppdList as $sp) {
            $items->push($this->normalizeSppd($sp));
        }

        $beritaAcaraList = BeritaAcara::query()
            ->with(['kodeKlasifikasi', 'creator', 'logVerifikasi.verifikator'])
            ->where('status', $status)
            ->orderByDesc('updated_at')
            ->get();

        foreach ($beritaAcaraList as $ba) {
            $items->push($this->normalizeBeritaAcara($ba));
        }

        return $items->sortByDesc('updated_at_timestamp')->values();
    }

    private function normalizeSuratKeluar(SuratKeluar $sk): array
    {
        $kodeBidang = $sk->kodeKlasifikasi->kode_bidang ?? '400';
        $namaBidang = $sk->kodeKlasifikasi->nama_bidang ?? 'Catatan Sipil';
        $filePath = $sk->file_konsep;

        return [
            'id' => $sk->id,
            'key' => 'surat_keluar_' . $sk->id,
            'jenis' => 'surat_keluar',
            'jenis_label' => 'Surat Keluar',
            'jenis_badge_bg' => '#DBEAFE',
            'jenis_badge_color' => '#1D4ED8',
            'nomor' => $sk->nomor_surat,
            'kode_bidang' => $kodeBidang,
            'nama_bidang' => $namaBidang,
            'tanggal_display' => $sk->tanggal_dikeluarkan ? $sk->tanggal_dikeluarkan->format('d F Y') : '-',
            'perihal' => $sk->perihal,
            'tujuan' => $sk->alamat_tujuan,
            'sifat' => $sk->sifat ?: 'Biasa',
            'lampiran' => $sk->lampiran ?: '1 (Satu) Berkas',
            'sub_info' => 'Tujuan: ' . $sk->alamat_tujuan,
            'pengaju_nama' => $sk->creator->nama_lengkap ?? 'Staf Admin Umpeg',
            'status' => $sk->status,
            'catatan_revisi' => $sk->catatan_revisi,
            'file_path' => $filePath,
            'file_url' => $filePath ? asset('storage/' . $filePath) : null,
            'file_name' => $filePath ? basename($filePath) : null,
            'extra' => [
                'nama_pegawai' => null,
                'nip_pegawai' => null,
                'jabatan_pegawai' => null,
                'tanggal_berangkat' => null,
                'tanggal_kembali' => null,
            ],
            'logs' => $this->mapLogVerifikasi($sk->logVerifikasi),
            'approve_url' => route('verifikasi.hierarki.approve', ['jenis' => 'surat_keluar', 'id' => $sk->id]),
            'revisi_url' => route('verifikasi.hierarki.revisi', ['jenis' => 'surat_keluar', 'id' => $sk->id]),
            'updated_at_timestamp' => $sk->updated_at?->timestamp ?? 0,
        ];
    }

    private function normalizeSppd(Sppd $sp): array
    {
        $kodeBidang = $sp->kodeKlasifikasi->kode_bidang ?? '800';
        $namaBidang = $sp->kodeKlasifikasi->nama_bidang ?? 'Kepegawaian';

        return [
            'id' => $sp->id,
            'key' => 'sppd_' . $sp->id,
            'jenis' => 'sppd',
            'jenis_label' => 'SPPD',
            'jenis_badge_bg' => '#FEF3C7',
            'jenis_badge_color' => '#B45309',
            'nomor' => $sp->nomor_sppd,
            'kode_bidang' => $kodeBidang,
            'nama_bidang' => $namaBidang,
            'tanggal_display' => $sp->tanggal_surat ? $sp->tanggal_surat->format('d F Y') : '-',
            'perihal' => $sp->urusan_perjalanan,
            'tujuan' => $sp->daerah_tujuan,
            'sifat' => 'Penting',
            'lampiran' => 'Surat Tugas & Lembar SPPD',
            'sub_info' => 'Pegawai: ' . $sp->nama_pegawai,
            'pengaju_nama' => $sp->creator->nama_lengkap ?? 'Staf Admin Umpeg',
            'status' => $sp->status,
            'catatan_revisi' => $sp->catatan_revisi,
            'file_path' => null,
            'file_url' => null,
            'file_name' => null,
            'extra' => [
                'nama_pegawai' => $sp->nama_pegawai,
                'nip_pegawai' => $sp->nip_pegawai ?: '-',
                'jabatan_pegawai' => $sp->jabatan_pegawai ?: 'Pegawai Disdukcapil OKI',
                'tanggal_berangkat' => $sp->tanggal_berangkat ? $sp->tanggal_berangkat->format('d M Y') : '-',
                'tanggal_kembali' => $sp->tanggal_kembali ? $sp->tanggal_kembali->format('d M Y') : '-',
            ],
            'logs' => $this->mapLogVerifikasi($sp->logVerifikasi),
            'approve_url' => route('verifikasi.hierarki.approve', ['jenis' => 'sppd', 'id' => $sp->id]),
            'revisi_url' => route('verifikasi.hierarki.revisi', ['jenis' => 'sppd', 'id' => $sp->id]),
            'updated_at_timestamp' => $sp->updated_at?->timestamp ?? 0,
        ];
    }

    private function normalizeBeritaAcara(BeritaAcara $ba): array
    {
        $kodeBidang = $ba->kodeKlasifikasi->kode_bidang ?? '400';
        $namaBidang = $ba->kodeKlasifikasi->nama_bidang ?? 'Catatan Sipil';
        $filePath = $ba->file_dokumen;

        return [
            'id' => $ba->id,
            'key' => 'berita_acara_' . $ba->id,
            'jenis' => 'berita_acara',
            'jenis_label' => 'Berita Acara',
            'jenis_badge_bg' => '#EDE9FE',
            'jenis_badge_color' => '#6D28D9',
            'nomor' => $ba->nomor_berita_acara,
            'kode_bidang' => $kodeBidang,
            'nama_bidang' => $namaBidang,
            'tanggal_display' => $ba->tanggal_berita_acara ? $ba->tanggal_berita_acara->format('d F Y') : '-',
            'perihal' => $ba->perihal,
            'tujuan' => $ba->pihak_kedua,
            'sifat' => 'Penting',
            'lampiran' => $filePath ? '1 (Satu) Berkas Berita Acara' : 'Dokumen Berita Acara',
            'sub_info' => 'Mitra/Pihak II: ' . $ba->pihak_kedua,
            'pengaju_nama' => $ba->creator->nama_lengkap ?? 'Staf Admin Umpeg',
            'status' => $ba->status,
            'catatan_revisi' => $ba->catatan_revisi,
            'file_path' => $filePath,
            'file_url' => $filePath ? asset('storage/' . $filePath) : null,
            'file_name' => $filePath ? basename($filePath) : null,
            'extra' => [
                'nama_pegawai' => null,
                'nip_pegawai' => null,
                'jabatan_pegawai' => null,
                'tanggal_berangkat' => null,
                'tanggal_kembali' => null,
            ],
            'logs' => $this->mapLogVerifikasi($ba->logVerifikasi),
            'approve_url' => route('verifikasi.hierarki.approve', ['jenis' => 'berita_acara', 'id' => $ba->id]),
            'revisi_url' => route('verifikasi.hierarki.revisi', ['jenis' => 'berita_acara', 'id' => $ba->id]),
            'updated_at_timestamp' => $ba->updated_at?->timestamp ?? 0,
        ];
    }

    private function mapLogVerifikasi(Collection $logs): array
    {
        return $logs->map(function ($log) {
            return [
                'tahap_verifikasi' => $log->tahap_verifikasi,
                'status_aksi' => $log->status_aksi,
                'verifikator_nama' => $log->verifikator->nama_lengkap ?? 'Pejabat / Sistem',
                'verifikator_jabatan' => $log->verifikator->jabatan ?? '-',
                'catatan' => $log->catatan,
                'checklist_pemeriksaan' => $log->checklist_pemeriksaan,
                'waktu' => $log->waktu_verifikasi ? $log->waktu_verifikasi->format('d M Y, H:i') . ' WIB' : '-',
            ];
        })->values()->all();
    }

    private function resolveNaskahModel(string $jenis, int $id): ?Model
    {
        return match ($jenis) {
            'surat_keluar' => SuratKeluar::find($id),
            'sppd' => Sppd::find($id),
            'berita_acara' => BeritaAcara::find($id),
            default => null,
        };
    }

    private function getNomorNaskah(Model $naskah, string $jenis): string
    {
        return match ($jenis) {
            'surat_keluar' => (string) $naskah->nomor_surat,
            'sppd' => (string) $naskah->nomor_sppd,
            'berita_acara' => (string) $naskah->nomor_berita_acara,
            default => '#',
        };
    }

    private function extractChecklist(Request $request): array
    {
        $raw = (array) $request->input('checklist', []);

        return [
            'kode_klasifikasi' => ! empty($raw['kode_klasifikasi']),
            'kelengkapan_lampiran' => ! empty($raw['kelengkapan_lampiran']),
            'ketepatan_redaksi' => ! empty($raw['ketepatan_redaksi']),
        ];
    }
}
