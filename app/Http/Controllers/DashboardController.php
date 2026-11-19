<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\Sppd;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan Dashboard Admin Subbag Umpeg dengan data metrik & tabel nyata dari MySQL.
     */
    public function index(): View
    {
        $totalSuratMasuk = SuratMasuk::query()->count();
        $suratMasukBaru = SuratMasuk::query()->where('status', 'baru')->count();

        $totalSuratKeluar = SuratKeluar::query()->count();
        $suratKeluarTte = SuratKeluar::query()->where('status', 'ttd_kadin')->count();

        $totalSppd = Sppd::query()->count();
        $totalBeritaAcara = BeritaAcara::query()->count();

        $menungguVerifikasi = SuratKeluar::query()->whereIn('status', ['draf', 'valid_kasubbag', 'valid_sekdin'])->count()
            + Sppd::query()->whereIn('status', ['draf', 'valid_kasubbag', 'valid_sekdin'])->count()
            + BeritaAcara::query()->whereIn('status', ['draf', 'valid_kasubbag', 'valid_sekdin'])->count();

        $revisiSuratKeluar = SuratKeluar::query()->with('kodeKlasifikasi')->where('status', 'revisi')->latest()->get();
        $revisiSppd = Sppd::query()->with('kodeKlasifikasi')->where('status', 'revisi')->latest()->get();
        $revisiBeritaAcara = BeritaAcara::query()->with('kodeKlasifikasi')->where('status', 'revisi')->latest()->get();

        $naskahRevisi = collect();
        foreach ($revisiSuratKeluar as $sk) {
            $naskahRevisi->push([
                'jenis_label' => 'Surat Keluar',
                'nomor' => $sk->nomor_surat,
                'perihal' => $sk->perihal,
                'tujuan' => $sk->alamat_tujuan,
                'catatan_revisi' => $sk->catatan_revisi,
                'kode_bidang' => $sk->kodeKlasifikasi->kode_bidang ?? '400',
            ]);
        }
        foreach ($revisiSppd as $sp) {
            $naskahRevisi->push([
                'jenis_label' => 'SPPD',
                'nomor' => $sp->nomor_sppd,
                'perihal' => $sp->urusan_perjalanan,
                'tujuan' => $sp->nama_pegawai . ' (' . $sp->daerah_tujuan . ')',
                'catatan_revisi' => $sp->catatan_revisi,
                'kode_bidang' => $sp->kodeKlasifikasi->kode_bidang ?? '800',
            ]);
        }
        foreach ($revisiBeritaAcara as $ba) {
            $naskahRevisi->push([
                'jenis_label' => 'Berita Acara',
                'nomor' => $ba->nomor_berita_acara,
                'perihal' => $ba->perihal,
                'tujuan' => $ba->pihak_kedua,
                'catatan_revisi' => $ba->catatan_revisi,
                'kode_bidang' => $ba->kodeKlasifikasi->kode_bidang ?? '400',
            ]);
        }

        $suratMasukTerbaru = SuratMasuk::query()
            ->with(['kodeKlasifikasi', 'disposisi'])
            ->orderByDesc('tanggal_diterima')
            ->orderByDesc('id')
            ->limit(10)
            ->get();

        return view('dashboard', [
            'totalSuratMasuk' => $totalSuratMasuk,
            'suratMasukBaru' => $suratMasukBaru,
            'totalSuratKeluar' => $totalSuratKeluar,
            'suratKeluarTte' => $suratKeluarTte,
            'totalSppd' => $totalSppd,
            'totalBeritaAcara' => $totalBeritaAcara,
            'menungguVerifikasi' => $menungguVerifikasi,
            'naskahRevisi' => $naskahRevisi,
            'suratMasukTerbaru' => $suratMasukTerbaru,
        ]);
    }
}
