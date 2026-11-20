<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\Sppd;
use App\Models\SuratKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class VerifikasiPublikController extends Controller
{
    /**
     * Menampilkan Portal Resmi Verifikasi Tanda Tangan Elektronik (GET /verifikasi-dokumen).
     * Mendukung parameter ?token= atau ?q= (pencarian berdasarkan tte_token_uuid maupun nomor surat resmi).
     */
    public function index(Request $request): View
    {
        $keyword = trim((string) ($request->query('token') ?? $request->query('q') ?? ''));

        // Ambil sampel token valid dari database untuk memudahkan pengujian cepat di UI pencarian
        $sampleTokens = collect();
        foreach (SuratKeluar::where('status', 'ttd_kadin')->whereNotNull('tte_token_uuid')->limit(2)->get() as $sk) {
            $sampleTokens->push(['label' => 'Surat Keluar', 'nomor' => $sk->nomor_surat, 'token' => $sk->tte_token_uuid]);
        }
        foreach (Sppd::where('status', 'ttd_kadin')->whereNotNull('tte_token_uuid')->limit(1)->get() as $sp) {
            $sampleTokens->push(['label' => 'SPPD', 'nomor' => $sp->nomor_sppd, 'token' => $sp->tte_token_uuid]);
        }
        foreach (BeritaAcara::where('status', 'ttd_kadin')->whereNotNull('tte_token_uuid')->limit(1)->get() as $ba) {
            $sampleTokens->push(['label' => 'Berita Acara', 'nomor' => $ba->nomor_berita_acara, 'token' => $ba->tte_token_uuid]);
        }

        if ($keyword === '') {
            return view('verifikasi-qr', [
                'searchState' => 'empty',
                'keyword' => '',
                'dokumen' => null,
                'unverifiedReason' => null,
                'sampleTokens' => $sampleTokens,
            ]);
        }

        [$foundModel, $foundJenis] = $this->findDocumentByKeyword($keyword);

        if (! $foundModel) {
            return view('verifikasi-qr', [
                'searchState' => 'unverified',
                'keyword' => $keyword,
                'dokumen' => null,
                'unverifiedReason' => 'Token UUID atau Nomor Naskah Dinas tidak terdaftar pada pangkalan data Buku Besar E-Surat Disdukcapil Kabupaten Ogan Komering Ilir.',
                'sampleTokens' => $sampleTokens,
            ]);
        }

        if ($foundModel->status !== 'ttd_kadin' || empty($foundModel->tte_token_uuid)) {
            $statusLabel = match ($foundModel->status) {
                'draf' => 'Menunggu Verifikasi Tahap 1 (Kasubbag Umpeg)',
                'valid_kasubbag' => 'Menunggu Paraf Tahap 2 (Sekretaris Dinas)',
                'valid_sekdin' => 'Menunggu Otorisasi Tanda Tangan Elektronik (Kepala Dinas)',
                'revisi' => 'Dikembalikan untuk Perbaikan / Revisi',
                default => $foundModel->status,
            };

            return view('verifikasi-qr', [
                'searchState' => 'unverified',
                'keyword' => $keyword,
                'dokumen' => null,
                'unverifiedReason' => "Naskah dengan nomor tersebut ditemukan di sistem dalam status \"{$statusLabel}\", namun BELUM memiliki pengesahan Tanda Tangan Elektronik (TTE QR Code) Kepala Dinas.",
                'sampleTokens' => $sampleTokens,
            ]);
        }

        $dokumen = $this->normalizeVerifiedDocument($foundModel, $foundJenis);

        return view('verifikasi-qr', [
            'searchState' => 'verified',
            'keyword' => $keyword,
            'dokumen' => $dokumen,
            'unverifiedReason' => null,
            'sampleTokens' => $sampleTokens,
        ]);
    }

    /**
     * Mengunduh Salinan Resmi PDF A4 Ber-QR Code (GET /verifikasi-dokumen/unduh/{token}).
     */
    public function unduhPdf(string $token): Response
    {
        $cleanToken = trim($token);
        [$foundModel, $foundJenis] = $this->findDocumentByToken($cleanToken);

        if (! $foundModel || $foundModel->status !== 'ttd_kadin' || empty($foundModel->tte_token_uuid)) {
            abort(404, 'Dokumen ber-TTE tidak ditemukan atau belum disahkan oleh Kepala Dinas.');
        }

        $dokumen = $this->normalizeVerifiedDocument($foundModel, $foundJenis);
        $rawSvg = KadinController::generateQrSvg($dokumen['tte_token_uuid'], 110);
        $qrBase64 = 'data:image/svg+xml;base64,' . base64_encode($rawSvg);

        $pdf = Pdf::loadView('pdf.salinan-resmi-tte', [
            'dokumen' => $dokumen,
            'qrBase64' => $qrBase64,
        ])->setPaper('a4', 'portrait');

        $safeNomor = preg_replace('/[^A-Za-z0-9\-]+/', '-', $dokumen['nomor']);
        $filename = 'Salinan-Resmi-TTE-' . trim((string) $safeNomor, '-') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Mencari dokumen berdasarkan Token UUID atau Nomor Surat di SuratKeluar, Sppd, dan BeritaAcara.
     *
     * @return array{0: ?Model, 1: ?string}
     */
    private function findDocumentByKeyword(string $keyword): array
    {
        $sk = SuratKeluar::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->where('tte_token_uuid', $keyword)
            ->orWhere('nomor_surat', $keyword)
            ->first();

        if ($sk) {
            return [$sk, 'surat_keluar'];
        }

        $sp = Sppd::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->where('tte_token_uuid', $keyword)
            ->orWhere('nomor_sppd', $keyword)
            ->first();

        if ($sp) {
            return [$sp, 'sppd'];
        }

        $ba = BeritaAcara::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->where('tte_token_uuid', $keyword)
            ->orWhere('nomor_berita_acara', $keyword)
            ->first();

        if ($ba) {
            return [$ba, 'berita_acara'];
        }

        return [null, null];
    }

    /**
     * Mencari dokumen khusus berdasarkan tte_token_uuid.
     *
     * @return array{0: ?Model, 1: ?string}
     */
    private function findDocumentByToken(string $token): array
    {
        $sk = SuratKeluar::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->where('tte_token_uuid', $token)
            ->first();

        if ($sk) {
            return [$sk, 'surat_keluar'];
        }

        $sp = Sppd::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->where('tte_token_uuid', $token)
            ->first();

        if ($sp) {
            return [$sp, 'sppd'];
        }

        $ba = BeritaAcara::query()
            ->with(['kodeKlasifikasi', 'creator', 'penandatangan', 'logVerifikasi.verifikator'])
            ->where('tte_token_uuid', $token)
            ->first();

        if ($ba) {
            return [$ba, 'berita_acara'];
        }

        return [null, null];
    }

    /**
     * Menormalisasi data dokumen yang telah sah ber-TTE untuk tampilan web & cetak PDF DomPDF.
     */
    private function normalizeVerifiedDocument(Model $model, string $jenis): array
    {
        $kodeBidang = $model->kodeKlasifikasi->kode_bidang ?? '400';
        $namaBidang = $model->kodeKlasifikasi->nama_bidang ?? 'Catatan Sipil';
        $tokenUuid = (string) $model->tte_token_uuid;

        $penandatangan = $model->penandatangan;
        $penandatanganNama = $penandatangan->nama_lengkap ?? 'Drs. H. Hendra Suryadi, M.Si';
        $penandatanganNip = $penandatangan->nip ?? '197108141998031004';
        $penandatanganJabatan = $penandatangan->jabatan ?? 'Kepala Dinas Dukcapil Kab. OKI';
        $penandatanganPangkat = $penandatangan->pangkat_golongan ?? 'Pembina Utama Muda (IV/c)';

        $logs = $model->logVerifikasi->map(function ($log) {
            $tahapLabel = match ($log->tahap_verifikasi) {
                'staf_admin' => 'Pengajuan Konsep: Staf Subbag Umpeg',
                'kasubbag_umpeg' => 'Verifikasi I: Kasubbag Umpeg',
                'sekretaris_dinas' => 'Verifikasi II: Sekretaris Dinas (Sekdin)',
                'kepala_dinas' => 'Otorisasi Final: Kepala Dinas Dukcapil OKI',
                default => $log->tahap_verifikasi,
            };

            return [
                'tahap_verifikasi' => $log->tahap_verifikasi,
                'tahap_label' => $tahapLabel,
                'status_aksi' => $log->status_aksi,
                'verifikator_nama' => $log->verifikator->nama_lengkap ?? 'Pejabat Disdukcapil OKI',
                'verifikator_jabatan' => $log->verifikator->jabatan ?? '-',
                'catatan' => $log->catatan,
                'waktu' => $log->waktu_verifikasi ? $log->waktu_verifikasi->format('d M Y, H:i') . ' WIB' : '-',
            ];
        })->values()->all();

        $common = [
            'id' => $model->id,
            'jenis' => $jenis,
            'kode_bidang' => $kodeBidang,
            'nama_bidang' => $namaBidang,
            'tte_token_uuid' => $tokenUuid,
            'qr_svg' => KadinController::generateQrSvg($tokenUuid, 92),
            'verify_url' => url('/verifikasi-dokumen?token=' . $tokenUuid),
            'unduh_url' => route('verifikasi.dokumen.unduh', ['token' => $tokenUuid]),
            'penandatangan_nama' => $penandatanganNama,
            'penandatangan_nip' => $penandatanganNip,
            'penandatangan_jabatan' => $penandatanganJabatan,
            'penandatangan_pangkat' => $penandatanganPangkat,
            'signed_at_display' => $model->signed_at ? $model->signed_at->format('d M Y, H:i:s') . ' WIB' : '-',
            'waktu_pindai' => now()->format('d M Y, H:i:s') . ' WIB',
            'logs' => $logs,
        ];

        if ($jenis === 'surat_keluar') {
            /** @var SuratKeluar $model */
            return array_merge($common, [
                'jenis_label' => 'Surat Keluar Resmi',
                'jenis_sub' => 'Naskah Dinas Eksternal',
                'jenis_icon' => 'bi-send-fill',
                'jenis_badge_bg' => '#DBEAFE',
                'jenis_badge_color' => '#1D4ED8',
                'nomor' => $model->nomor_surat,
                'tanggal_display' => $model->tanggal_dikeluarkan ? $model->tanggal_dikeluarkan->translatedFormat('d F Y') : '-',
                'perihal' => $model->perihal,
                'tujuan' => $model->alamat_tujuan,
                'sifat' => $model->sifat ?: 'Penting',
                'lampiran' => $model->lampiran ?: '1 (Satu) Berkas',
                'extra' => [],
            ]);
        }

        if ($jenis === 'sppd') {
            /** @var Sppd $model */
            return array_merge($common, [
                'jenis_label' => 'SPPD (Perjalanan Dinas)',
                'jenis_sub' => 'Surat Perintah Perjalanan Dinas',
                'jenis_icon' => 'bi-briefcase-fill',
                'jenis_badge_bg' => '#FEF3C7',
                'jenis_badge_color' => '#B45309',
                'nomor' => $model->nomor_sppd,
                'tanggal_display' => $model->tanggal_surat ? $model->tanggal_surat->translatedFormat('d F Y') : '-',
                'perihal' => $model->urusan_perjalanan,
                'tujuan' => $model->daerah_tujuan,
                'sifat' => 'Penting',
                'lampiran' => 'Surat Tugas & Visum SPPD',
                'extra' => [
                    'nama_pegawai' => $model->nama_pegawai,
                    'nip_pegawai' => $model->nip_pegawai ?: '-',
                    'jabatan_pegawai' => $model->jabatan_pegawai ?: '-',
                    'tanggal_berangkat' => $model->tanggal_berangkat ? $model->tanggal_berangkat->translatedFormat('d F Y') : '-',
                    'tanggal_kembali' => $model->tanggal_kembali ? $model->tanggal_kembali->translatedFormat('d F Y') : '-',
                ],
            ]);
        }

        /** @var BeritaAcara $model */
        return array_merge($common, [
            'jenis_label' => 'Berita Acara Kedinasan',
            'jenis_sub' => 'Berita Acara Serah Terima / Rekonsiliasi',
            'jenis_icon' => 'bi-file-earmark-text-fill',
            'jenis_badge_bg' => '#EDE9FE',
            'jenis_badge_color' => '#6D28D9',
            'nomor' => $model->nomor_berita_acara,
            'tanggal_display' => $model->tanggal_berita_acara ? $model->tanggal_berita_acara->translatedFormat('d F Y') : '-',
            'perihal' => $model->perihal,
            'tujuan' => $model->pihak_kedua,
            'sifat' => 'Penting',
            'lampiran' => '1 (Satu) Berkas Berita Acara',
            'extra' => [],
        ]);
    }
}
