<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\Sppd;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BukuBesarController extends Controller
{
    /**
     * Menampilkan halaman Buku Besar & Laporan Arsip Lintas Role (GET /buku-besar).
     */
    public function index(Request $request): View
    {
        $metrics = $this->getGlobalMetrics();
        $sidebarBadges = $this->getAllRoleSidebarBadges();
        $filters = $this->extractFilters($request);

        $filteredItems = $this->buildFilteredCollection($filters);

        $perPage = 10;
        $currentPage = max((int) $request->query('page', 1), 1);
        $currentPageItems = $filteredItems->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginator = new LengthAwarePaginator(
            $currentPageItems,
            $filteredItems->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('buku-besar', array_merge(
            $metrics,
            $sidebarBadges,
            [
                'filters' => $filters,
                'filteredTotal' => $filteredItems->count(),
                'ledgerItems' => $paginator,
            ]
        ));
    }

    /**
     * Mengekspor data rekapitulasi Buku Besar sesuai filter aktif ke format Excel CSV UTF-8 BOM (GET /buku-besar/export-excel).
     */
    public function exportExcel(Request $request): StreamedResponse
    {
        $filters = $this->extractFilters($request);
        $items = $this->buildFilteredCollection($filters);

        $filename = 'Buku_Besar_Disdukcapil_OKI_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($items) {
            $handle = fopen('php://output', 'w');

            // Tulis UTF-8 BOM agar Microsoft Excel langsung mengenali encoding & pemisah kolom dengan rapi
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'No. Agenda',
                'Tanggal Naskah',
                'Nomor Naskah Dinas',
                'Kategori Naskah',
                'Kode Klasifikasi Bidang',
                'Pengirim / Tujuan / Pegawai',
                'Rincian / Ajudan / Sifat',
                'Perihal / Pokok Naskah',
                'Status Verifikasi / Disposisi',
                'Token UUID TTE',
            ]);

            foreach ($items as $row) {
                fputcsv($handle, [
                    $row['no_agenda'],
                    $row['tanggal_display'],
                    $row['nomor_naskah'],
                    $row['kategori_label'],
                    'Kode ' . $row['kode_bidang'] . ' - ' . $row['nama_bidang'],
                    $row['pihak_utama'],
                    $row['pihak_sub'],
                    $row['perihal'],
                    $row['status_label'],
                    $row['tte_token_uuid'] ?: '-',
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /**
     * Mencetak laporan rekapitulasi Buku Besar ke format PDF A4 Landscape (GET /buku-besar/export-pdf).
     */
    public function exportPdf(Request $request): Response
    {
        $filters = $this->extractFilters($request);
        $items = $this->buildFilteredCollection($filters);
        $metrics = $this->getGlobalMetrics();

        $summaryByKategori = [
            'surat_masuk' => $items->where('jenis', 'surat_masuk')->count(),
            'surat_keluar' => $items->where('jenis', 'surat_keluar')->count(),
            'sppd' => $items->where('jenis', 'sppd')->count(),
            'berita_acara' => $items->where('jenis', 'berita_acara')->count(),
            'total' => $items->count(),
        ];

        $pdf = Pdf::loadView('pdf.rekap-buku-besar', [
            'items' => $items,
            'filters' => $filters,
            'metrics' => $metrics,
            'summary' => $summaryByKategori,
            'dicetakOleh' => auth()->user(),
            'waktuCetak' => now()->translatedFormat('d F Y, H:i') . ' WIB',
        ])->setPaper('a4', 'landscape');

        $filename = 'Laporan_Rekap_Buku_Besar_Disdukcapil_OKI_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Menghitung 4 kartu metrik utama & jumlah tab kategori langsung dari MySQL.
     */
    private function getGlobalMetrics(): array
    {
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();
        $totalSuratKeluarTte = SuratKeluar::where('status', 'ttd_kadin')->count();
        $totalSppd = Sppd::count();
        $totalBeritaAcara = BeritaAcara::count();
        $totalAgenda = $totalSuratMasuk + $totalSuratKeluar + $totalSppd + $totalBeritaAcara;

        return [
            'totalAgenda' => $totalAgenda,
            'totalSuratMasuk' => $totalSuratMasuk,
            'totalSuratKeluar' => $totalSuratKeluar,
            'totalSuratKeluarTte' => $totalSuratKeluarTte,
            'totalSppd' => $totalSppd,
            'totalBeritaAcara' => $totalBeritaAcara,
        ];
    }

    /**
     * Menghitung seluruh variabel badge notifikasi sidebar untuk ke-4 role (admin, kasubbag, sekdin, kadin).
     */
    private function getAllRoleSidebarBadges(): array
    {
        $sidebarRevisiCount = SuratKeluar::where('status', 'revisi')->count()
            + Sppd::where('status', 'revisi')->count()
            + BeritaAcara::where('status', 'revisi')->count();

        $verifTahap1Count = SuratKeluar::where('status', 'draf')->count()
            + Sppd::where('status', 'draf')->count()
            + BeritaAcara::where('status', 'draf')->count();

        $verifTahap2Count = SuratKeluar::where('status', 'valid_kasubbag')->count()
            + Sppd::where('status', 'valid_kasubbag')->count()
            + BeritaAcara::where('status', 'valid_kasubbag')->count();

        $kadinCounters = KadinController::getSidebarCounters();

        return [
            'sidebarRevisiCount' => $sidebarRevisiCount,
            'verifTahap1Count' => $verifTahap1Count,
            'verifTahap2Count' => $verifTahap2Count,
            'kadinCounters' => $kadinCounters,
            'menungguTteCount' => $kadinCounters['menungguTteCount'],
            'menungguDisposisiCount' => $kadinCounters['menungguDisposisiCount'],
        ];
    }

    private function extractFilters(Request $request): array
    {
        $rawJenis = trim((string) $request->query('jenis', 'semua'));
        $normalizedJenis = match (strtolower($rawJenis)) {
            'surat_masuk', 'surat masuk' => 'surat_masuk',
            'surat_keluar', 'surat keluar' => 'surat_keluar',
            'sppd' => 'sppd',
            'berita_acara', 'berita acara' => 'berita_acara',
            default => 'semua',
        };

        $rawKode = trim((string) $request->query('kode_bidang', 'semua'));
        $normalizedKode = match (str_replace('kode ', '', strtolower($rawKode))) {
            '400' => '400',
            '800' => '800',
            '00' => '00',
            default => 'semua',
        };

        $rawStatus = trim((string) $request->query('status', 'semua'));
        $normalizedStatus = in_array($rawStatus, ['ttd_kadin', 'valid_sekdin', 'valid_kasubbag', 'draf', 'revisi', 'selesai', 'diproses', 'baru'], true)
            ? $rawStatus
            : 'semua';

        return [
            'tanggal_dari' => trim((string) $request->query('tanggal_dari', '')),
            'tanggal_sampai' => trim((string) $request->query('tanggal_sampai', '')),
            'jenis' => $normalizedJenis,
            'kode_bidang' => $normalizedKode,
            'status' => $normalizedStatus,
            'q' => trim((string) $request->query('q', '')),
        ];
    }

    /**
     * Mengumpulkan, menormalisasi, dan memfilter seluruh rekaman naskah dinas lintas 4 tabel utama.
     */
    private function buildFilteredCollection(array $filters): Collection
    {
        $all = collect();

        // 1. Surat Masuk
        $suratMasukList = SuratMasuk::query()
            ->with(['kodeKlasifikasi', 'disposisi.kadin', 'disposisi.kodeKlasifikasi'])
            ->orderByDesc('tanggal_diterima')
            ->orderByDesc('id')
            ->get();

        foreach ($suratMasukList as $sm) {
            $kodeBidang = $sm->kodeKlasifikasi->kode_bidang ?? '400';
            $namaBidang = $sm->kodeKlasifikasi->nama_bidang ?? 'Catatan Sipil';
            $disp = $sm->disposisi->last();

            [$statusLabel, $badgeBg, $badgeColor, $badgeIcon] = match ($sm->status) {
                'selesai' => ['Disposisi Selesai', '#DCFCE7', '#15803D', 'bi-check2-all'],
                'diproses' => ['Diproses Kadin / Unit', '#FEF3C7', '#B45309', 'bi-hourglass-split'],
                default => ['Baru Diagendakan', '#DBEAFE', '#1D4ED8', 'bi-envelope'],
            };

            $disposisiDetail = null;
            if ($disp) {
                $disposisiDetail = [
                    'unit' => $disp->diserahkan_kepada_unit,
                    'penerima' => $disp->nama_pegawai_penerima,
                    'tanggal_menerima' => $disp->tanggal_menerima ? $disp->tanggal_menerima->format('d M Y') : '-',
                    'sifat' => $disp->sifat_disposisi,
                    'instruksi' => is_array($disp->instruksi_cepat) ? implode(', ', $disp->instruksi_cepat) : '-',
                    'catatan_kadin' => $disp->catatan_kadin ?: '-',
                    'status_disposisi' => strtoupper($disp->status_disposisi),
                    'pejabat_kadin' => $disp->kadin->nama_lengkap ?? 'Kepala Dinas Dukcapil OKI',
                ];
            }

            $all->push([
                'key' => 'surat_masuk_' . $sm->id,
                'id' => $sm->id,
                'jenis' => 'surat_masuk',
                'kategori_label' => 'Surat Masuk',
                'kategori_badge_bg' => '#E0F2FE',
                'kategori_badge_color' => '#0369A1',
                'kategori_icon' => 'bi-inbox-fill',
                'no_agenda' => '#SM-' . $sm->nomor_urut_agenda,
                'tanggal_raw' => $sm->tanggal_diterima ? $sm->tanggal_diterima->format('Y-m-d') : '',
                'tanggal_display' => $sm->tanggal_diterima ? $sm->tanggal_diterima->format('d M Y') : '-',
                'sort_timestamp' => $sm->tanggal_diterima ? $sm->tanggal_diterima->timestamp : 0,
                'nomor_naskah' => $sm->nomor_surat,
                'kode_bidang' => $kodeBidang,
                'nama_bidang' => $namaBidang,
                'pihak_utama' => $sm->pengirim,
                'pihak_sub' => $sm->nama_ajudan_penerima ? ('Ajudan: ' . $sm->nama_ajudan_penerima) : ('Sifat: ' . $sm->sifat_surat),
                'perihal' => $sm->perihal,
                'sifat' => $sm->sifat_surat,
                'status_raw' => $sm->status,
                'status_label' => $statusLabel,
                'status_badge_bg' => $badgeBg,
                'status_badge_color' => $badgeColor,
                'status_icon' => $badgeIcon,
                'tte_token_uuid' => null,
                'signed_at_display' => null,
                'penandatangan_nama' => null,
                'verify_url' => null,
                'unduh_tte_url' => null,
                'file_url' => $sm->file_lampiran ? asset('storage/' . $sm->file_lampiran) : null,
                'disposisi_detail' => $disposisiDetail,
                'logs' => [],
            ]);
        }

        // 2. Surat Keluar
        $suratKeluarList = SuratKeluar::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->orderByDesc('tanggal_dikeluarkan')
            ->orderByDesc('id')
            ->get();

        foreach ($suratKeluarList as $sk) {
            $kodeBidang = $sk->kodeKlasifikasi->kode_bidang ?? '400';
            $namaBidang = $sk->kodeKlasifikasi->nama_bidang ?? 'Catatan Sipil';
            [$statusLabel, $badgeBg, $badgeColor, $badgeIcon] = $this->resolveHierarkiBadge($sk->status);
            $isTte = $sk->status === 'ttd_kadin' && ! empty($sk->tte_token_uuid);

            $all->push([
                'key' => 'surat_keluar_' . $sk->id,
                'id' => $sk->id,
                'jenis' => 'surat_keluar',
                'kategori_label' => 'Surat Keluar',
                'kategori_badge_bg' => '#DBEAFE',
                'kategori_badge_color' => '#1D4ED8',
                'kategori_icon' => 'bi-send-fill',
                'no_agenda' => '#AG-' . str_pad((string) $sk->nomor_urut, 4, '0', STR_PAD_LEFT),
                'tanggal_raw' => $sk->tanggal_dikeluarkan ? $sk->tanggal_dikeluarkan->format('Y-m-d') : '',
                'tanggal_display' => $sk->tanggal_dikeluarkan ? $sk->tanggal_dikeluarkan->format('d M Y') : '-',
                'sort_timestamp' => $sk->tanggal_dikeluarkan ? $sk->tanggal_dikeluarkan->timestamp : 0,
                'nomor_naskah' => $sk->nomor_surat,
                'kode_bidang' => $kodeBidang,
                'nama_bidang' => $namaBidang,
                'pihak_utama' => $sk->alamat_tujuan,
                'pihak_sub' => 'Sifat: ' . ($sk->sifat ?: 'Penting') . ' • Lampiran: ' . ($sk->lampiran ?: '-'),
                'perihal' => $sk->perihal,
                'sifat' => $sk->sifat ?: 'Penting',
                'status_raw' => $sk->status,
                'status_label' => $statusLabel,
                'status_badge_bg' => $badgeBg,
                'status_badge_color' => $badgeColor,
                'status_icon' => $badgeIcon,
                'tte_token_uuid' => $sk->tte_token_uuid,
                'signed_at_display' => $sk->signed_at ? $sk->signed_at->format('d M Y, H:i') . ' WIB' : null,
                'penandatangan_nama' => $sk->penandatangan->nama_lengkap ?? 'Drs. H. Hendra Suryadi, M.Si',
                'verify_url' => $isTte ? route('verifikasi.dokumen', ['token' => $sk->tte_token_uuid]) : null,
                'unduh_tte_url' => $isTte ? route('verifikasi.dokumen.unduh', ['token' => $sk->tte_token_uuid]) : null,
                'file_url' => $sk->file_konsep ? asset('storage/' . $sk->file_konsep) : null,
                'disposisi_detail' => null,
                'logs' => $this->mapLogs($sk->logVerifikasi),
            ]);
        }

        // 3. SPPD
        $sppdList = Sppd::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->orderByDesc('tanggal_surat')
            ->orderByDesc('id')
            ->get();

        foreach ($sppdList as $sp) {
            $kodeBidang = $sp->kodeKlasifikasi->kode_bidang ?? '800';
            $namaBidang = $sp->kodeKlasifikasi->nama_bidang ?? 'Kepegawaian';
            [$statusLabel, $badgeBg, $badgeColor, $badgeIcon] = $this->resolveHierarkiBadge($sp->status);
            $isTte = $sp->status === 'ttd_kadin' && ! empty($sp->tte_token_uuid);

            $all->push([
                'key' => 'sppd_' . $sp->id,
                'id' => $sp->id,
                'jenis' => 'sppd',
                'kategori_label' => 'SPPD',
                'kategori_badge_bg' => '#FEF3C7',
                'kategori_badge_color' => '#B45309',
                'kategori_icon' => 'bi-briefcase-fill',
                'no_agenda' => '#SP-' . str_pad((string) $sp->nomor_urut, 4, '0', STR_PAD_LEFT),
                'tanggal_raw' => $sp->tanggal_surat ? $sp->tanggal_surat->format('Y-m-d') : '',
                'tanggal_display' => $sp->tanggal_surat ? $sp->tanggal_surat->format('d M Y') : '-',
                'sort_timestamp' => $sp->tanggal_surat ? $sp->tanggal_surat->timestamp : 0,
                'nomor_naskah' => $sp->nomor_sppd,
                'kode_bidang' => $kodeBidang,
                'nama_bidang' => $namaBidang,
                'pihak_utama' => $sp->nama_pegawai,
                'pihak_sub' => 'Tujuan: ' . $sp->daerah_tujuan,
                'perihal' => $sp->urusan_perjalanan,
                'sifat' => 'Penting',
                'status_raw' => $sp->status,
                'status_label' => $statusLabel,
                'status_badge_bg' => $badgeBg,
                'status_badge_color' => $badgeColor,
                'status_icon' => $badgeIcon,
                'tte_token_uuid' => $sp->tte_token_uuid,
                'signed_at_display' => $sp->signed_at ? $sp->signed_at->format('d M Y, H:i') . ' WIB' : null,
                'penandatangan_nama' => $sp->penandatangan->nama_lengkap ?? 'Drs. H. Hendra Suryadi, M.Si',
                'verify_url' => $isTte ? route('verifikasi.dokumen', ['token' => $sp->tte_token_uuid]) : null,
                'unduh_tte_url' => $isTte ? route('verifikasi.dokumen.unduh', ['token' => $sp->tte_token_uuid]) : null,
                'file_url' => null,
                'disposisi_detail' => null,
                'logs' => $this->mapLogs($sp->logVerifikasi),
            ]);
        }

        // 4. Berita Acara
        $beritaAcaraList = BeritaAcara::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->orderByDesc('tanggal_berita_acara')
            ->orderByDesc('id')
            ->get();

        foreach ($beritaAcaraList as $ba) {
            $kodeBidang = $ba->kodeKlasifikasi->kode_bidang ?? '400';
            $namaBidang = $ba->kodeKlasifikasi->nama_bidang ?? 'Catatan Sipil';
            [$statusLabel, $badgeBg, $badgeColor, $badgeIcon] = $this->resolveHierarkiBadge($ba->status);
            $isTte = $ba->status === 'ttd_kadin' && ! empty($ba->tte_token_uuid);

            $all->push([
                'key' => 'berita_acara_' . $ba->id,
                'id' => $ba->id,
                'jenis' => 'berita_acara',
                'kategori_label' => 'Berita Acara',
                'kategori_badge_bg' => '#EDE9FE',
                'kategori_badge_color' => '#6D28D9',
                'kategori_icon' => 'bi-file-earmark-text-fill',
                'no_agenda' => '#BA-' . str_pad((string) $ba->nomor_urut, 4, '0', STR_PAD_LEFT),
                'tanggal_raw' => $ba->tanggal_berita_acara ? $ba->tanggal_berita_acara->format('Y-m-d') : '',
                'tanggal_display' => $ba->tanggal_berita_acara ? $ba->tanggal_berita_acara->format('d M Y') : '-',
                'sort_timestamp' => $ba->tanggal_berita_acara ? $ba->tanggal_berita_acara->timestamp : 0,
                'nomor_naskah' => $ba->nomor_berita_acara,
                'kode_bidang' => $kodeBidang,
                'nama_bidang' => $namaBidang,
                'pihak_utama' => $ba->pihak_kedua,
                'pihak_sub' => 'Mitra / Pihak Kedua BA',
                'perihal' => $ba->perihal,
                'sifat' => 'Penting',
                'status_raw' => $ba->status,
                'status_label' => $statusLabel,
                'status_badge_bg' => $badgeBg,
                'status_badge_color' => $badgeColor,
                'status_icon' => $badgeIcon,
                'tte_token_uuid' => $ba->tte_token_uuid,
                'signed_at_display' => $ba->signed_at ? $ba->signed_at->format('d M Y, H:i') . ' WIB' : null,
                'penandatangan_nama' => $ba->penandatangan->nama_lengkap ?? 'Drs. H. Hendra Suryadi, M.Si',
                'verify_url' => $isTte ? route('verifikasi.dokumen', ['token' => $ba->tte_token_uuid]) : null,
                'unduh_tte_url' => $isTte ? route('verifikasi.dokumen.unduh', ['token' => $ba->tte_token_uuid]) : null,
                'file_url' => $ba->file_dokumen ? asset('storage/' . $ba->file_dokumen) : null,
                'disposisi_detail' => null,
                'logs' => $this->mapLogs($ba->logVerifikasi),
            ]);
        }

        // Terapkan filter
        return $all
            ->filter(function (array $item) use ($filters) {
                if ($filters['jenis'] !== 'semua' && $item['jenis'] !== $filters['jenis']) {
                    return false;
                }

                if ($filters['kode_bidang'] !== 'semua' && $item['kode_bidang'] !== $filters['kode_bidang']) {
                    return false;
                }

                if ($filters['status'] !== 'semua' && $item['status_raw'] !== $filters['status']) {
                    return false;
                }

                if ($filters['tanggal_dari'] !== '' && $item['tanggal_raw'] !== '' && $item['tanggal_raw'] < $filters['tanggal_dari']) {
                    return false;
                }

                if ($filters['tanggal_sampai'] !== '' && $item['tanggal_raw'] !== '' && $item['tanggal_raw'] > $filters['tanggal_sampai']) {
                    return false;
                }

                if ($filters['q'] !== '') {
                    $needle = mb_strtolower($filters['q']);
                    $haystack = mb_strtolower(
                        $item['no_agenda'] . ' ' .
                        $item['nomor_naskah'] . ' ' .
                        $item['pihak_utama'] . ' ' .
                        $item['pihak_sub'] . ' ' .
                        $item['perihal'] . ' ' .
                        ($item['tte_token_uuid'] ?? '')
                    );

                    if (! str_contains($haystack, $needle)) {
                        return false;
                    }
                }

                return true;
            })
            ->sortByDesc('sort_timestamp')
            ->values();
    }

    private function resolveHierarkiBadge(string $status): array
    {
        return match ($status) {
            'ttd_kadin' => ['Sah Ber-TTE Kadin', '#DCFCE7', '#15803D', 'bi-qr-code'],
            'valid_sekdin' => ['Antrean TTE Kadin', '#EDE9FE', '#6D28D9', 'bi-hourglass-split'],
            'valid_kasubbag' => ['Tahap 2: Paraf Sekdin', '#DBEAFE', '#1D4ED8', 'bi-vector-pen'],
            'revisi' => ['Perlu Revisi Admin', '#FEE2E2', '#B91C1C', 'bi-arrow-counterclockwise'],
            default => ['Tahap 1: Verif Kasubbag', '#FEF3C7', '#B45309', 'bi-clock-history'],
        };
    }

    private function mapLogs(Collection $logs): array
    {
        return $logs->map(function ($log) {
            $tahapLabel = match ($log->tahap_verifikasi) {
                'staf_admin' => 'Staf Admin Umpeg (Pengaju Konsep)',
                'kasubbag_umpeg' => 'Kasubbag Umpeg (Verifikasi Tahap 1)',
                'sekretaris_dinas' => 'Sekretaris Dinas (Paraf Tahap 2)',
                'kepala_dinas' => 'Kepala Dinas (Otorisasi TTE QR Code)',
                default => $log->tahap_verifikasi,
            };

            return [
                'tahap_label' => $tahapLabel,
                'status_aksi' => $log->status_aksi,
                'verifikator_nama' => $log->verifikator->nama_lengkap ?? 'Pejabat Disdukcapil OKI',
                'catatan' => $log->catatan,
                'waktu' => $log->waktu_verifikasi ? $log->waktu_verifikasi->format('d M Y, H:i') . ' WIB' : '-',
            ];
        })->values()->all();
    }
}
