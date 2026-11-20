<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\DisposisiSuratMasuk;
use App\Models\KodeKlasifikasi;
use App\Models\Sppd;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KadinController extends Controller
{
    /**
     * Menghasilkan QR Code berformat inline SVG murni (tanpa membutuhkan ekstensi imagick/gd)
     * yang mengarah ke Portal Verifikasi Publik: url('/verifikasi-dokumen?token=' . $tokenUuid).
     */
    public static function generateQrSvg(string $tokenUuid, int $size = 86): string
    {
        $verifyUrl = url('/verifikasi-dokumen?token=' . urlencode($tokenUuid));

        $renderer = new ImageRenderer(
            new RendererStyle($size, 1),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $svg = $writer->writeString($verifyUrl);

        // Hapus deklarasi XML agar dapat disematkan langsung sebagai elemen HTML <svg>
        return (string) preg_replace('/^<\?xml[^>]*\?>\s*/i', '', $svg);
    }

    /**
     * Menghitung jumlah badge notifikasi sidebar Kepala Dinas secara real-time dari MySQL.
     */
    public static function getSidebarCounters(): array
    {
        $menungguTteCount = SuratKeluar::where('status', 'valid_sekdin')->count()
            + Sppd::where('status', 'valid_sekdin')->count()
            + BeritaAcara::where('status', 'valid_sekdin')->count();

        $menungguDisposisiCount = SuratMasuk::where('status_kenaikan', 'diterima_ajudan')
            ->whereDoesntHave('disposisi')
            ->count();

        return [
            'menungguTteCount' => $menungguTteCount,
            'menungguDisposisiCount' => $menungguDisposisiCount,
        ];
    }

    /**
     * 1. Dashboard Eksekutif Kepala Dinas (/kadin).
     */
    public function dashboard(): View
    {
        $counters = self::getSidebarCounters();

        $antreanTte = $this->collectNaskahByStatus('valid_sekdin');

        $countSelesaiTte = SuratKeluar::where('status', 'ttd_kadin')->count()
            + Sppd::where('status', 'ttd_kadin')->count()
            + BeritaAcara::where('status', 'ttd_kadin')->count();

        $totalSppd = Sppd::count();
        $totalBeritaAcara = BeritaAcara::count();
        $totalSppdBa = $totalSppd + $totalBeritaAcara;

        $countSkAntrean = $antreanTte->where('jenis', 'surat_keluar')->count();
        $countSppdAntrean = $antreanTte->where('jenis', 'sppd')->count();
        $countBaAntrean = $antreanTte->where('jenis', 'berita_acara')->count();

        return view('dashboard-kadin', [
            'menungguTteCount' => $counters['menungguTteCount'],
            'menungguDisposisiCount' => $counters['menungguDisposisiCount'],
            'countSelesaiTte' => $countSelesaiTte,
            'totalSppd' => $totalSppd,
            'totalBeritaAcara' => $totalBeritaAcara,
            'totalSppdBa' => $totalSppdBa,
            'antreanTte' => $antreanTte,
            'countSkAntrean' => $countSkAntrean,
            'countSppdAntrean' => $countSppdAntrean,
            'countBaAntrean' => $countBaAntrean,
        ]);
    }

    /**
     * 2. Otorisasi Tanda Tangan Elektronik (TTE) Massal dari Dashboard Kadin (POST /kadin/tte-massal).
     */
    public function tteMassal(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate(
            [
                'pin_tte' => ['required', 'string'],
                'items' => ['required', 'array', 'min:1'],
                'items.*' => ['required', 'string'],
                'catatan' => ['nullable', 'string', 'max:500'],
            ],
            [
                'pin_tte.required' => 'PIN / Passphrase TTE Kepala Dinas wajib dimasukkan untuk otorisasi TTE Massal.',
                'items.required' => 'Pilih minimal satu dokumen dari antrean untuk ditandatangani secara massal.',
                'items.min' => 'Pilih minimal satu dokumen dari antrean untuk ditandatangani secara massal.',
            ]
        );

        if (empty($user->pin_tte)) {
            return back()->with('error', 'PIN TTE Anda belum diatur. Silakan atur PIN TTE terlebih dahulu melalui menu Pengaturan PIN / Passphrase TTE.');
        }

        if (! Hash::check($validated['pin_tte'], $user->pin_tte)) {
            return back()->with('error', 'Otorisasi TTE Massal Gagal: PIN / Passphrase TTE Kepala Dinas yang Anda masukkan tidak sesuai.');
        }

        $signedNumbers = [];
        $catatanCustom = trim((string) ($validated['catatan'] ?? ''));

        DB::transaction(function () use ($validated, $user, $catatanCustom, &$signedNumbers) {
            foreach ($validated['items'] as $itemKey) {
                if (! preg_match('/^(surat_keluar|sppd|berita_acara)_(\d+)$/', $itemKey, $matches)) {
                    continue;
                }

                $jenis = $matches[1];
                $id = (int) $matches[2];
                $naskah = $this->resolveNaskahModel($jenis, $id);

                if (! $naskah || $naskah->status !== 'valid_sekdin') {
                    continue;
                }

                $tokenUuid = (string) Str::uuid();
                $nomorNaskah = $this->getNomorNaskah($naskah, $jenis);

                $naskah->update([
                    'status' => 'ttd_kadin',
                    'catatan_revisi' => null,
                    'tte_token_uuid' => $tokenUuid,
                    'signed_by' => $user->id,
                    'signed_at' => now(),
                ]);

                $naskah->logVerifikasi()->create([
                    'tahap_verifikasi' => 'kepala_dinas',
                    'status_aksi' => 'ttd_kadin',
                    'verifikator_id' => $user->id,
                    'catatan' => $catatanCustom ?: "Sah & dibubuhkan Tanda Tangan Elektronik (TTE Massal) QR Code UUID ({$tokenUuid}).",
                    'checklist_pemeriksaan' => ['otorisasi_tte_qr' => true, 'tte_massal' => true],
                    'waktu_verifikasi' => now(),
                ]);

                $signedNumbers[] = $nomorNaskah;
            }
        });

        if (empty($signedNumbers)) {
            return back()->with('error', 'Tidak ada naskah berstatus Menunggu TTE Kadin (valid_sekdin) yang dapat diproses.');
        }

        $jumlah = count($signedNumbers);
        $daftarNomor = implode(', ', array_slice($signedNumbers, 0, 4)) . ($jumlah > 4 ? '...' : '');

        return redirect()
            ->route('dashboard.kadin')
            ->with('status', "Otorisasi TTE Massal Berhasil: {$jumlah} naskah dinas ({$daftarNomor}) telah sah dibubuhkan Tanda Tangan Elektronik QR Code UUID.");
    }

    /**
     * 3. Halaman Validasi & Otorisasi TTE QR Code (/kadin/validasi).
     */
    public function validasi(Request $request): View
    {
        $counters = self::getSidebarCounters();

        // Antrean aktif berstatus 'valid_sekdin'
        $antreanValidasi = $this->collectNaskahByStatus('valid_sekdin');

        // Riwayat naskah yang sudah selesai TTE ('ttd_kadin') agar Kadin bisa langsung melihat hasil QR Code SVG
        $riwayatTte = $this->collectNaskahByStatus('ttd_kadin');

        $selectedJenis = $request->query('jenis');
        $selectedId = $request->query('id') ? (int) $request->query('id') : null;

        $activeDoc = null;

        if ($selectedJenis && $selectedId) {
            $activeDoc = $antreanValidasi->first(fn (array $item) => $item['jenis'] === $selectedJenis && $item['id'] === $selectedId)
                ?? $riwayatTte->first(fn (array $item) => $item['jenis'] === $selectedJenis && $item['id'] === $selectedId);
        }

        if (! $activeDoc) {
            $activeDoc = $antreanValidasi->first() ?? $riwayatTte->first();
        }

        return view('validasi-ttd', [
            'menungguTteCount' => $counters['menungguTteCount'],
            'menungguDisposisiCount' => $counters['menungguDisposisiCount'],
            'antreanValidasi' => $antreanValidasi,
            'riwayatTte' => $riwayatTte,
            'activeDoc' => $activeDoc,
        ]);
    }

    /**
     * 4. Eksekusi Otorisasi TTE Tunggal dengan Validasi PIN TTE (POST /kadin/validasi/{jenis}/{id}/tte).
     */
    public function approveTte(Request $request, string $jenis, int $id): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $naskah = $this->resolveNaskahModel($jenis, $id);

        if (! $naskah) {
            return back()->with('error', 'Data naskah dinas tidak ditemukan.');
        }

        if ($naskah->status !== 'valid_sekdin') {
            return redirect()
                ->route('kadin.validasi', ['jenis' => $jenis, 'id' => $id])
                ->with('error', 'Naskah ini tidak berada pada status Menunggu TTE Kepala Dinas (valid_sekdin).');
        }

        $validated = $request->validate(
            [
                'pin_tte' => ['required', 'string'],
                'catatan' => ['nullable', 'string', 'max:1000'],
            ],
            [
                'pin_tte.required' => 'Passphrase / PIN Keamanan TTE wajib dimasukkan untuk menerbitkan QR Code UUID.',
            ]
        );

        if (empty($user->pin_tte)) {
            return back()->with('error', 'PIN TTE Anda belum diatur. Silakan atur PIN TTE terlebih dahulu melalui menu Pengaturan PIN / Passphrase TTE.');
        }

        if (! Hash::check($validated['pin_tte'], $user->pin_tte)) {
            return back()
                ->withInput($request->only('catatan'))
                ->with('error', 'Otorisasi TTE Gagal: Passphrase / PIN Keamanan TTE yang Anda masukkan salah.');
        }

        $tokenUuid = (string) Str::uuid();
        $nomorNaskah = $this->getNomorNaskah($naskah, $jenis);
        $catatanFinal = trim((string) ($validated['catatan'] ?? ''))
            ?: "Sah & dibubuhkan Tanda Tangan Elektronik QR Code UUID ({$tokenUuid}) oleh Kepala Dinas.";

        DB::transaction(function () use ($naskah, $tokenUuid, $user, $catatanFinal) {
            $naskah->update([
                'status' => 'ttd_kadin',
                'catatan_revisi' => null,
                'tte_token_uuid' => $tokenUuid,
                'signed_by' => $user->id,
                'signed_at' => now(),
            ]);

            $naskah->logVerifikasi()->create([
                'tahap_verifikasi' => 'kepala_dinas',
                'status_aksi' => 'ttd_kadin',
                'verifikator_id' => $user->id,
                'catatan' => $catatanFinal,
                'checklist_pemeriksaan' => ['otorisasi_tte_qr' => true],
                'waktu_verifikasi' => now(),
            ]);
        });

        return redirect()
            ->route('kadin.validasi', ['jenis' => $jenis, 'id' => $naskah->id])
            ->with('status', "Otorisasi Tanda Tangan Elektronik Berhasil! Naskah {$nomorNaskah} telah disahkan dengan Token UUID: {$tokenUuid}.")
            ->with('just_signed_uuid', $tokenUuid)
            ->with('just_signed_nomor', $nomorNaskah);
    }

    /**
     * 5. Kembalikan Naskah dari Kadin untuk Revisi (POST /kadin/validasi/{jenis}/{id}/revisi).
     */
    public function revisiNaskah(Request $request, string $jenis, int $id): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $naskah = $this->resolveNaskahModel($jenis, $id);

        if (! $naskah) {
            return back()->with('error', 'Data naskah dinas tidak ditemukan.');
        }

        if ($naskah->status !== 'valid_sekdin') {
            return redirect()
                ->route('kadin.validasi')
                ->with('error', 'Hanya naskah berstatus Menunggu TTE Kadin (valid_sekdin) yang dapat dikembalikan untuk revisi.');
        }

        $validated = $request->validate(
            [
                'catatan_revisi' => ['required', 'string', 'min:5', 'max:1000'],
            ],
            [
                'catatan_revisi.required' => 'Catatan koreksi Kepala Dinas wajib diisi sebelum mengembalikan dokumen untuk revisi.',
                'catatan_revisi.min' => 'Catatan koreksi minimal terdiri dari 5 karakter.',
            ]
        );

        $catatanRevisi = trim($validated['catatan_revisi']);
        $nomorNaskah = $this->getNomorNaskah($naskah, $jenis);

        DB::transaction(function () use ($naskah, $user, $catatanRevisi) {
            $naskah->update([
                'status' => 'revisi',
                'catatan_revisi' => $catatanRevisi,
            ]);

            $naskah->logVerifikasi()->create([
                'tahap_verifikasi' => 'kepala_dinas',
                'status_aksi' => 'revisi',
                'verifikator_id' => $user->id,
                'catatan' => $catatanRevisi,
                'checklist_pemeriksaan' => ['otorisasi_tte_qr' => false],
                'waktu_verifikasi' => now(),
            ]);
        });

        return redirect()
            ->route('kadin.validasi')
            ->with('status', "Naskah {$nomorNaskah} telah dikembalikan ke Staf Admin dengan status Revisi beserta catatan koreksi Kepala Dinas.");
    }

    /**
     * 6. Halaman Disposisi Surat Masuk Kepala Dinas (/kadin/disposisi).
     */
    public function disposisi(Request $request): View
    {
        $counters = self::getSidebarCounters();

        // Daftar seluruh surat masuk yang sudah naik ke Ajudan/Kadin (prioritas yang belum punya disposisi)
        $suratMasukKadinList = SuratMasuk::query()
            ->with(['kodeKlasifikasi', 'disposisi.kadin', 'disposisi.kodeKlasifikasi'])
            ->where('status_kenaikan', 'diterima_ajudan')
            ->get()
            ->sortBy(function (SuratMasuk $sm) {
                if ($sm->disposisi->isEmpty()) {
                    return 1; // Prioritas utama: belum didisposisi
                }
                if ($sm->status === 'diproses') {
                    return 2; // Sedang diproses
                }

                return 3; // Selesai
            })
            ->values();

        $selectedId = $request->query('surat_masuk_id') ? (int) $request->query('surat_masuk_id') : null;
        $activeSuratMasuk = null;

        if ($selectedId) {
            $activeSuratMasuk = $suratMasukKadinList->firstWhere('id', $selectedId)
                ?? SuratMasuk::with(['kodeKlasifikasi', 'disposisi.kadin'])->find($selectedId);
        }

        if (! $activeSuratMasuk) {
            $activeSuratMasuk = $suratMasukKadinList->first();
        }

        // Riwayat seluruh disposisi surat masuk
        $riwayatDisposisiList = DisposisiSuratMasuk::query()
            ->with(['suratMasuk.kodeKlasifikasi', 'kodeKlasifikasi', 'kadin'])
            ->orderByDesc('tanggal_menerima')
            ->orderByDesc('id')
            ->get();

        $klasifikasiList = KodeKlasifikasi::query()->orderBy('id')->get();

        return view('disposisi-masuk', [
            'menungguTteCount' => $counters['menungguTteCount'],
            'menungguDisposisiCount' => $counters['menungguDisposisiCount'],
            'suratMasukKadinList' => $suratMasukKadinList,
            'activeSuratMasuk' => $activeSuratMasuk,
            'riwayatDisposisiList' => $riwayatDisposisiList,
            'klasifikasiList' => $klasifikasiList,
        ]);
    }

    /**
     * 7. Menyimpan / Memperbarui Instruksi Disposisi Kepala Dinas (POST /kadin/disposisi/{suratMasuk}).
     */
    public function storeDisposisi(Request $request, SuratMasuk $suratMasuk): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate(
            [
                'kode_bidang' => ['required', 'string', 'exists:kode_klasifikasi,kode_bidang'],
                'diserahkan_kepada_unit' => ['required', 'string', 'max:150'],
                'nama_pegawai_penerima' => ['required', 'string', 'max:255'],
                'tanggal_menerima' => ['required', 'date'],
                'sifat_disposisi' => ['required', 'string', Rule::in(['Segera', 'Penting', 'Rahasia', 'Biasa'])],
                'instruksi_cepat' => ['nullable', 'array'],
                'instruksi_cepat.*' => ['string', 'max:100'],
                'catatan_kadin' => ['nullable', 'string', 'max:1500'],
                'status_disposisi' => ['nullable', 'string', Rule::in(['diproses', 'selesai', 'diarsipkan'])],
            ],
            [
                'kode_bidang.required' => 'Bidang / Subbagian tujuan disposisi wajib dipilih.',
                'nama_pegawai_penerima.required' => 'Nama pejabat / staf penerima disposisi wajib diisi.',
                'tanggal_menerima.required' => 'Tanggal terima disposisi wajib diisi.',
                'sifat_disposisi.required' => 'Sifat disposisi wajib dipilih.',
            ]
        );

        $klasifikasi = KodeKlasifikasi::where('kode_bidang', $validated['kode_bidang'])->firstOrFail();
        $instruksiCepat = array_values(array_filter((array) ($validated['instruksi_cepat'] ?? [])));

        // Tentukan status_disposisi: jika memilih instruksi 'Arsipkan', bisa otomatis 'diarsipkan', atau sesuai input
        $statusDisposisi = $validated['status_disposisi'] ?? 'diproses';
        if (in_array('Arsipkan', $instruksiCepat, true) && empty($validated['status_disposisi'])) {
            $statusDisposisi = 'diarsipkan';
        }

        $statusSuratMasuk = in_array($statusDisposisi, ['selesai', 'diarsipkan'], true) ? 'selesai' : 'diproses';

        DB::transaction(function () use ($suratMasuk, $klasifikasi, $validated, $instruksiCepat, $statusDisposisi, $statusSuratMasuk, $user) {
            DisposisiSuratMasuk::updateOrCreate(
                ['surat_masuk_id' => $suratMasuk->id],
                [
                    'kode_klasifikasi_id' => $klasifikasi->id,
                    'diserahkan_kepada_unit' => trim($validated['diserahkan_kepada_unit']),
                    'nama_pegawai_penerima' => trim($validated['nama_pegawai_penerima']),
                    'tanggal_menerima' => $validated['tanggal_menerima'],
                    'sifat_disposisi' => $validated['sifat_disposisi'],
                    'instruksi_cepat' => $instruksiCepat,
                    'catatan_kadin' => trim((string) ($validated['catatan_kadin'] ?? '')) ?: null,
                    'status_disposisi' => $statusDisposisi,
                    'didisposisi_oleh' => $user->id,
                ]
            );

            $suratMasuk->update([
                'kode_klasifikasi_id' => $klasifikasi->id,
                'status_kenaikan' => 'diterima_ajudan',
                'tanggal_naik_kadin' => $suratMasuk->tanggal_naik_kadin ?? now(),
                'status' => $statusSuratMasuk,
            ]);
        });

        return redirect()
            ->route('kadin.disposisi', ['surat_masuk_id' => $suratMasuk->id])
            ->with('status', "Instruksi Disposisi Kepala Dinas untuk Surat Masuk #{$suratMasuk->nomor_urut_agenda} ({$suratMasuk->pengirim}) berhasil disimpan dan diserahkan kepada {$validated['nama_pegawai_penerima']} ({$validated['diserahkan_kepada_unit']}).");
    }

    /**
     * 8. Memperbarui Status Tindak Lanjut Disposisi (PATCH /kadin/disposisi/{disposisi}/status).
     */
    public function updateStatusDisposisi(Request $request, DisposisiSuratMasuk $disposisi): RedirectResponse
    {
        $validated = $request->validate([
            'status_disposisi' => ['required', 'string', Rule::in(['diproses', 'selesai', 'diarsipkan'])],
        ]);

        $newStatus = $validated['status_disposisi'];
        $disposisi->update(['status_disposisi' => $newStatus]);

        if ($disposisi->suratMasuk) {
            $disposisi->suratMasuk->update([
                'status' => in_array($newStatus, ['selesai', 'diarsipkan'], true) ? 'selesai' : 'diproses',
            ]);
        }

        $agendaNo = $disposisi->suratMasuk->nomor_urut_agenda ?? '-';

        return back()->with('status', "Status disposisi Surat Masuk #{$agendaNo} berhasil diperbarui menjadi: " . strtoupper($newStatus) . '.');
    }

    /**
     * 9. Pengaturan Mandiri PIN / Passphrase TTE Kepala Dinas (Zero-Knowledge Admin — PATCH /kadin/pin-tte).
     */
    public function updatePinTte(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate(
            [
                'kredensial_verifikasi' => ['required', 'string'],
                'pin_tte_baru' => ['required', 'digits:6', 'confirmed'],
            ],
            [
                'kredensial_verifikasi.required' => 'Masukkan PIN TTE saat ini atau Kata Sandi (Password) akun Anda untuk verifikasi keamanan.',
                'pin_tte_baru.required' => 'PIN TTE baru wajib diisi.',
                'pin_tte_baru.digits' => 'PIN TTE baru wajib terdiri dari tepat 6 digit angka.',
                'pin_tte_baru.confirmed' => 'Konfirmasi PIN TTE baru tidak cocok.',
            ]
        );

        $inputAuth = $validated['kredensial_verifikasi'];
        $matchesPassword = Hash::check($inputAuth, $user->password);
        $matchesOldPin = ! empty($user->pin_tte) && Hash::check($inputAuth, $user->pin_tte);

        if (! $matchesPassword && ! $matchesOldPin) {
            return back()->with('error', 'Pembaruan PIN TTE Gagal: PIN TTE Saat Ini atau Kata Sandi Akun yang Anda masukkan tidak sesuai.');
        }

        $user->update([
            'pin_tte' => $validated['pin_tte_baru'],
        ]);

        return back()->with('status', 'PIN / Passphrase TTE 6 Digit Kepala Dinas berhasil diperbarui dan dienkripsi (Zero-Knowledge Admin).');
    }

    /**
     * Mengambil dan menormalisasi seluruh jenis naskah (SuratKeluar, Sppd, BeritaAcara) berdasarkan status.
     */
    private function collectNaskahByStatus(string $status): Collection
    {
        $items = collect();

        $suratKeluarList = SuratKeluar::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->where('status', $status)
            ->orderByDesc('updated_at')
            ->get();

        foreach ($suratKeluarList as $sk) {
            $items->push($this->normalizeSuratKeluar($sk));
        }

        $sppdList = Sppd::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->where('status', $status)
            ->orderByDesc('updated_at')
            ->get();

        foreach ($sppdList as $sp) {
            $items->push($this->normalizeSppd($sp));
        }

        $beritaAcaraList = BeritaAcara::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
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
        $tokenUuid = $sk->tte_token_uuid;

        return [
            'id' => $sk->id,
            'key' => 'surat_keluar_' . $sk->id,
            'jenis' => 'surat_keluar',
            'jenis_label' => 'Surat Keluar',
            'jenis_badge_bg' => '#DBEAFE',
            'jenis_badge_color' => '#1D4ED8',
            'jenis_icon' => 'bi-send-fill',
            'nomor' => $sk->nomor_surat,
            'kode_bidang' => $kodeBidang,
            'nama_bidang' => $namaBidang,
            'tanggal_short' => $sk->tanggal_dikeluarkan ? $sk->tanggal_dikeluarkan->format('d M Y') : '-',
            'tanggal_display' => $sk->tanggal_dikeluarkan ? $sk->tanggal_dikeluarkan->translatedFormat('d F Y') : '-',
            'perihal' => $sk->perihal,
            'tujuan' => $sk->alamat_tujuan,
            'sifat' => $sk->sifat ?: 'Penting',
            'lampiran' => $sk->lampiran ?: '1 (Satu) Berkas',
            'sub_info' => 'Tujuan: ' . $sk->alamat_tujuan,
            'pengaju_nama' => $sk->creator->nama_lengkap ?? 'Staf Admin Umpeg',
            'status' => $sk->status,
            'tte_token_uuid' => $tokenUuid,
            'qr_svg' => $tokenUuid ? self::generateQrSvg($tokenUuid, 84) : null,
            'verify_url' => $tokenUuid ? url('/verifikasi-dokumen?token=' . $tokenUuid) : null,
            'signed_at_display' => $sk->signed_at ? $sk->signed_at->format('d M Y, H:i') . ' WIB' : null,
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
            'validasi_url' => route('kadin.validasi', ['jenis' => 'surat_keluar', 'id' => $sk->id]),
            'tte_url' => route('kadin.validasi.tte', ['jenis' => 'surat_keluar', 'id' => $sk->id]),
            'revisi_url' => route('kadin.validasi.revisi', ['jenis' => 'surat_keluar', 'id' => $sk->id]),
            'updated_at_timestamp' => $sk->updated_at?->timestamp ?? 0,
        ];
    }

    private function normalizeSppd(Sppd $sp): array
    {
        $kodeBidang = $sp->kodeKlasifikasi->kode_bidang ?? '800';
        $namaBidang = $sp->kodeKlasifikasi->nama_bidang ?? 'Kepegawaian';
        $tokenUuid = $sp->tte_token_uuid;

        return [
            'id' => $sp->id,
            'key' => 'sppd_' . $sp->id,
            'jenis' => 'sppd',
            'jenis_label' => 'SPPD',
            'jenis_badge_bg' => '#FEF3C7',
            'jenis_badge_color' => '#B45309',
            'jenis_icon' => 'bi-briefcase-fill',
            'nomor' => $sp->nomor_sppd,
            'kode_bidang' => $kodeBidang,
            'nama_bidang' => $namaBidang,
            'tanggal_short' => $sp->tanggal_surat ? $sp->tanggal_surat->format('d M Y') : '-',
            'tanggal_display' => $sp->tanggal_surat ? $sp->tanggal_surat->translatedFormat('d F Y') : '-',
            'perihal' => $sp->urusan_perjalanan,
            'tujuan' => $sp->daerah_tujuan,
            'sifat' => 'Penting',
            'lampiran' => 'Surat Tugas & Lembar SPPD',
            'sub_info' => 'Pegawai: ' . $sp->nama_pegawai . ' (' . $sp->daerah_tujuan . ')',
            'pengaju_nama' => $sp->creator->nama_lengkap ?? 'Staf Admin Umpeg',
            'status' => $sp->status,
            'tte_token_uuid' => $tokenUuid,
            'qr_svg' => $tokenUuid ? self::generateQrSvg($tokenUuid, 84) : null,
            'verify_url' => $tokenUuid ? url('/verifikasi-dokumen?token=' . $tokenUuid) : null,
            'signed_at_display' => $sp->signed_at ? $sp->signed_at->format('d M Y, H:i') . ' WIB' : null,
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
            'validasi_url' => route('kadin.validasi', ['jenis' => 'sppd', 'id' => $sp->id]),
            'tte_url' => route('kadin.validasi.tte', ['jenis' => 'sppd', 'id' => $sp->id]),
            'revisi_url' => route('kadin.validasi.revisi', ['jenis' => 'sppd', 'id' => $sp->id]),
            'updated_at_timestamp' => $sp->updated_at?->timestamp ?? 0,
        ];
    }

    private function normalizeBeritaAcara(BeritaAcara $ba): array
    {
        $kodeBidang = $ba->kodeKlasifikasi->kode_bidang ?? '400';
        $namaBidang = $ba->kodeKlasifikasi->nama_bidang ?? 'Catatan Sipil';
        $filePath = $ba->file_dokumen;
        $tokenUuid = $ba->tte_token_uuid;

        return [
            'id' => $ba->id,
            'key' => 'berita_acara_' . $ba->id,
            'jenis' => 'berita_acara',
            'jenis_label' => 'Berita Acara',
            'jenis_badge_bg' => '#EDE9FE',
            'jenis_badge_color' => '#6D28D9',
            'jenis_icon' => 'bi-file-earmark-text-fill',
            'nomor' => $ba->nomor_berita_acara,
            'kode_bidang' => $kodeBidang,
            'nama_bidang' => $namaBidang,
            'tanggal_short' => $ba->tanggal_berita_acara ? $ba->tanggal_berita_acara->format('d M Y') : '-',
            'tanggal_display' => $ba->tanggal_berita_acara ? $ba->tanggal_berita_acara->translatedFormat('d F Y') : '-',
            'perihal' => $ba->perihal,
            'tujuan' => $ba->pihak_kedua,
            'sifat' => 'Penting',
            'lampiran' => $filePath ? '1 (Satu) Berkas Berita Acara' : 'Dokumen Berita Acara',
            'sub_info' => 'Mitra/Pihak II: ' . $ba->pihak_kedua,
            'pengaju_nama' => $ba->creator->nama_lengkap ?? 'Staf Admin Umpeg',
            'status' => $ba->status,
            'tte_token_uuid' => $tokenUuid,
            'qr_svg' => $tokenUuid ? self::generateQrSvg($tokenUuid, 84) : null,
            'verify_url' => $tokenUuid ? url('/verifikasi-dokumen?token=' . $tokenUuid) : null,
            'signed_at_display' => $ba->signed_at ? $ba->signed_at->format('d M Y, H:i') . ' WIB' : null,
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
            'validasi_url' => route('kadin.validasi', ['jenis' => 'berita_acara', 'id' => $ba->id]),
            'tte_url' => route('kadin.validasi.tte', ['jenis' => 'berita_acara', 'id' => $ba->id]),
            'revisi_url' => route('kadin.validasi.revisi', ['jenis' => 'berita_acara', 'id' => $ba->id]),
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
}
