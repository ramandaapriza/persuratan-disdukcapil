<?php

namespace Database\Seeders;

use App\Models\BeritaAcara;
use App\Models\DisposisiSuratMasuk;
use App\Models\KodeKlasifikasi;
use App\Models\LogVerifikasi;
use App\Models\Sppd;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed 3 Kode Klasifikasi Bidang (400, 800, 00)
        $bidang400 = KodeKlasifikasi::updateOrCreate(
            ['kode_bidang' => '400'],
            [
                'nama_bidang' => 'Bidang Catatan Sipil',
                'keterangan' => 'Pelayanan Akta Kelahiran, Akta Kematian, Perkawinan, dan Sinkronisasi SIAK Terpusat.',
            ]
        );

        $bidang800 = KodeKlasifikasi::updateOrCreate(
            ['kode_bidang' => '800'],
            [
                'nama_bidang' => 'Subbag Kepegawaian & Umum',
                'keterangan' => 'Pengelolaan SPPD, Administrasi Kepegawaian, dan Tata Usaha Umum.',
            ]
        );

        $bidang00 = KodeKlasifikasi::updateOrCreate(
            ['kode_bidang' => '00'],
            [
                'nama_bidang' => 'Subbag Keuangan / Dana',
                'keterangan' => 'Pengajuan SPP-GU, Laporan Realisasi Anggaran, dan Dana Operasional.',
            ]
        );

        // 2. Seed Akun Pegawai Multi-Role (Admin, Kasubbag Umpeg, Sekdin, Kadin dengan PIN TTE)
        $kadin = User::updateOrCreate(
            ['nip' => '197108141998031004'],
            [
                'nama_lengkap' => 'Drs. H. Hendra Suryadi, M.Si',
                'jabatan' => 'Kepala Dinas Dukcapil Kab. OKI',
                'pangkat_golongan' => 'Pembina Utama Muda (IV/c)',
                'no_hp' => '081271000001',
                'email' => 'hendra.suryadi@kaboki.go.id',
                'role' => User::ROLE_KADIN,
                'password' => 'password123',
                'pin_tte' => '123456',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $sekdin = User::updateOrCreate(
            ['nip' => '197405212000031002'],
            [
                'nama_lengkap' => 'Ir. H. Bambang Irawan, M.M',
                'jabatan' => 'Sekretaris Dinas (Sekdin)',
                'pangkat_golongan' => 'Pembina Tk. I (IV/b)',
                'no_hp' => '081271000002',
                'email' => 'bambang.irawan@kaboki.go.id',
                'role' => User::ROLE_SEKDIN,
                'password' => 'password123',
                'pin_tte' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $kasubbag = User::updateOrCreate(
            ['nip' => '197911032005012006'],
            [
                'nama_lengkap' => 'Hj. Siti Rahmawati, S.Sos., M.Si',
                'jabatan' => 'Kasubbag Umum & Kepegawaian',
                'pangkat_golongan' => 'Penata Tk. I (III/d)',
                'no_hp' => '081271000003',
                'email' => 'siti.rahmawati@kaboki.go.id',
                'role' => User::ROLE_KASUBBAG,
                'password' => 'password123',
                'pin_tte' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $admin = User::updateOrCreate(
            ['nip' => '198504122010011008'],
            [
                'nama_lengkap' => 'Rizky Pratama, S.IP',
                'jabatan' => 'Analis Tata Usaha / Ajudan',
                'pangkat_golongan' => 'Penata Muda Tk. I (III/b)',
                'no_hp' => '081271000004',
                'email' => 'rizky.pratama@kaboki.go.id',
                'role' => User::ROLE_ADMIN,
                'password' => 'password123',
                'pin_tte' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $admin2 = User::updateOrCreate(
            ['nip' => '199209182019031005'],
            [
                'nama_lengkap' => 'Dedi Kurniawan, A.Md.Kom',
                'jabatan' => 'Pengelola Surat & Arsip Digital',
                'pangkat_golongan' => 'Pengatur Tk. I (II/d)',
                'no_hp' => '081271000005',
                'email' => 'dedi.kurniawan@kaboki.go.id',
                'role' => User::ROLE_ADMIN,
                'password' => 'password123',
                'pin_tte' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // 3. Seed Surat Masuk & Disposisi Surat Masuk
        $sm0142 = SuratMasuk::updateOrCreate(
            ['nomor_urut_agenda' => '0142'],
            [
                'tanggal_diterima' => '2026-11-09',
                'pengirim' => 'Sekretariat Daerah Kab. OKI',
                'tanggal_surat' => '2026-11-06',
                'nomor_surat' => '005/341/Setda-OKI/2026',
                'perihal' => 'Permintaan Data Agregat Kependudukan Bersih Semester II',
                'sifat_surat' => 'Segera',
                'kode_klasifikasi_id' => $bidang400->id,
                'tanggal_naik_kadin' => '2026-11-10 08:15:00',
                'ajudan_id' => $admin->id,
                'nama_ajudan_penerima' => 'Rizky Pratama, S.IP',
                'status_kenaikan' => 'diterima_ajudan',
                'status' => 'diproses',
                'created_by' => $admin->id,
            ]
        );

        DisposisiSuratMasuk::updateOrCreate(
            ['surat_masuk_id' => $sm0142->id],
            [
                'kode_klasifikasi_id' => $bidang400->id,
                'diserahkan_kepada_unit' => 'Bidang Catatan Sipil (Kode 400)',
                'nama_pegawai_penerima' => 'Drs. H. M. Amin, M.Si (Kabid PIAK & Capil)',
                'tanggal_menerima' => '2026-11-10',
                'sifat_disposisi' => 'Segera',
                'instruksi_cepat' => ['Tindak Lanjuti', 'Siapkan Konsep Balasan'],
                'catatan_kadin' => 'Segera rekapitulasi data DAK2 Semester II yang telah tervalidasi SIAK Terpusat, koordinasikan draf surat pengantar dengan Sekdin sebelum dinaikkan untuk TTE.',
                'status_disposisi' => 'diproses',
                'didisposisi_oleh' => $kadin->id,
            ]
        );

        $sm0141 = SuratMasuk::updateOrCreate(
            ['nomor_urut_agenda' => '0141'],
            [
                'tanggal_diterima' => '2026-11-08',
                'pengirim' => 'BKPSDM Kabupaten OKI',
                'tanggal_surat' => '2026-11-06',
                'nomor_surat' => '800/512/BKPSDM-II/2026',
                'perihal' => 'Usulan Penyesuaian Formasi Pegawai Pelayanan Adminduk',
                'sifat_surat' => 'Penting',
                'kode_klasifikasi_id' => $bidang800->id,
                'tanggal_naik_kadin' => '2026-11-08 13:40:00',
                'ajudan_id' => $admin->id,
                'nama_ajudan_penerima' => 'Rizky Pratama, S.IP',
                'status_kenaikan' => 'diterima_ajudan',
                'status' => 'selesai',
                'created_by' => $admin->id,
            ]
        );

        DisposisiSuratMasuk::updateOrCreate(
            ['surat_masuk_id' => $sm0141->id],
            [
                'kode_klasifikasi_id' => $bidang800->id,
                'diserahkan_kepada_unit' => 'Subbag Kepegawaian & Umum (Kode 800)',
                'nama_pegawai_penerima' => 'Hj. Siti Rahmawati, S.Sos',
                'tanggal_menerima' => '2026-11-09',
                'sifat_disposisi' => 'Penting',
                'instruksi_cepat' => ['Tindak Lanjuti'],
                'catatan_kadin' => 'Telaah usulan formasi pegawai dan siapkan laporan ke BKPSDM.',
                'status_disposisi' => 'selesai',
                'didisposisi_oleh' => $kadin->id,
            ]
        );

        $sm0140 = SuratMasuk::updateOrCreate(
            ['nomor_urut_agenda' => '0140'],
            [
                'tanggal_diterima' => '2026-11-07',
                'pengirim' => 'Badan Pengelola Keuangan & Aset Daerah',
                'tanggal_surat' => '2026-11-05',
                'nomor_surat' => '900/219/BPKAD-OKI/2026',
                'perihal' => 'Pedoman Penyusunan Laporan Realisasi Anggaran Triwulan IV',
                'sifat_surat' => 'Biasa',
                'kode_klasifikasi_id' => $bidang00->id,
                'tanggal_naik_kadin' => '2026-11-07 10:20:00',
                'ajudan_id' => $admin2->id,
                'nama_ajudan_penerima' => 'Dedi Kurniawan, A.Md',
                'status_kenaikan' => 'diterima_ajudan',
                'status' => 'selesai',
                'created_by' => $admin2->id,
            ]
        );

        DisposisiSuratMasuk::updateOrCreate(
            ['surat_masuk_id' => $sm0140->id],
            [
                'kode_klasifikasi_id' => $bidang00->id,
                'diserahkan_kepada_unit' => 'Subbag Keuangan (Kode 00)',
                'nama_pegawai_penerima' => 'Hendri Wijaya, S.E., Ak',
                'tanggal_menerima' => '2026-11-07',
                'sifat_disposisi' => 'Biasa',
                'instruksi_cepat' => ['Tindak Lanjuti', 'Koordinasikan'],
                'catatan_kadin' => 'Sesuaikan format laporan realisasi anggaran dengan pedoman BPKAD.',
                'status_disposisi' => 'selesai',
                'didisposisi_oleh' => $kadin->id,
            ]
        );

        SuratMasuk::updateOrCreate(
            ['nomor_urut_agenda' => '0143'],
            [
                'tanggal_diterima' => '2026-11-11',
                'pengirim' => 'Ditjen Dukcapil Kemendagri RI',
                'tanggal_surat' => '2026-11-09',
                'nomor_surat' => '470/1204/Dukcapil/2026',
                'perihal' => 'Undangan Koordinasi Pemanfaatan Identitas Kependudukan Digital (IKD) Semester II',
                'sifat_surat' => 'Penting',
                'kode_klasifikasi_id' => $bidang400->id,
                'tanggal_naik_kadin' => '2026-11-11 09:30:00',
                'ajudan_id' => $admin->id,
                'nama_ajudan_penerima' => 'Rizky Pratama, S.IP',
                'status_kenaikan' => 'diterima_ajudan',
                'status' => 'diproses',
                'created_by' => $admin->id,
            ]
        );

        SuratMasuk::updateOrCreate(
            ['nomor_urut_agenda' => '0144'],
            [
                'tanggal_diterima' => '2026-11-14',
                'pengirim' => 'Pengadilan Agama Kayuagung',
                'tanggal_surat' => '2026-11-12',
                'nomor_surat' => 'W6-A4/892/HK.05/XI/2026',
                'perihal' => 'Penyampaian Salinan Putusan Perubahan Status Perkawinan & Hak Asuh Anak',
                'sifat_surat' => 'Biasa',
                'kode_klasifikasi_id' => $bidang400->id,
                'tanggal_naik_kadin' => null,
                'ajudan_id' => null,
                'nama_ajudan_penerima' => null,
                'status_kenaikan' => 'belum_naik',
                'status' => 'baru',
                'created_by' => $admin->id,
            ]
        );

        // 4. Seed Surat Keluar (termasuk 400/2763/disdukcapil/2026 dengan Token UUID TTE)
        $sk2763 = SuratKeluar::updateOrCreate(
            ['nomor_surat' => '400/2763/disdukcapil/2026'],
            [
                'nomor_urut' => 2763,
                'kode_klasifikasi_id' => $bidang400->id,
                'tahun' => 2026,
                'tanggal_dikeluarkan' => '2026-11-12',
                'alamat_tujuan' => 'Direktorat Jenderal Dukcapil Kemendagri RI - Jakarta',
                'perihal' => 'Penyampaian Laporan Rekapitulasi Penerbitan Akta Pencatatan Sipil dan Sinkronisasi Data Kependudukan Semester II Tahun 2026',
                'sifat' => 'Penting',
                'lampiran' => '1 (Satu) Berkas',
                'status' => 'ttd_kadin',
                'tte_token_uuid' => 'e8b7a9c2-4f1d-4a9b-8c3e-9102f84a712b',
                'signed_by' => $kadin->id,
                'signed_at' => '2026-11-12 14:20:08',
                'created_by' => $admin->id,
            ]
        );

        $sk189 = SuratKeluar::updateOrCreate(
            ['nomor_surat' => '470/189/Disdukcapil-OKI/XI/2026'],
            [
                'nomor_urut' => 189,
                'kode_klasifikasi_id' => $bidang400->id,
                'tahun' => 2026,
                'tanggal_dikeluarkan' => '2026-11-10',
                'alamat_tujuan' => 'Kepala Dinas Komunikasi dan Informatika Kabupaten OKI',
                'perihal' => 'Koordinasi Integrasi SIAK Terpusat dengan Portal Satu Data Kab. OKI',
                'sifat' => 'Penting',
                'lampiran' => '1 (Satu) Berkas',
                'status' => 'valid_sekdin',
                'tte_token_uuid' => null,
                'signed_by' => null,
                'signed_at' => null,
                'created_by' => $admin->id,
            ]
        );

        $sk2762 = SuratKeluar::updateOrCreate(
            ['nomor_surat' => '00/2762/disdukcapil/2026'],
            [
                'nomor_urut' => 2762,
                'kode_klasifikasi_id' => $bidang00->id,
                'tahun' => 2026,
                'tanggal_dikeluarkan' => '2026-11-09',
                'alamat_tujuan' => 'BPKAD Kabupaten OKI - Kayuagung',
                'perihal' => 'Pengajuan SPP-GU dan Laporan Realisasi Dana Operasional Pelayanan Keliling',
                'sifat' => 'Biasa',
                'lampiran' => '1 (Satu) Bundel',
                'status' => 'valid_sekdin',
                'tte_token_uuid' => null,
                'signed_by' => null,
                'signed_at' => null,
                'created_by' => $admin->id,
            ]
        );

        $sk2764Revisi = SuratKeluar::updateOrCreate(
            ['nomor_surat' => '400/2764/disdukcapil/2026'],
            [
                'nomor_urut' => 2764,
                'kode_klasifikasi_id' => $bidang400->id,
                'tahun' => 2026,
                'tanggal_dikeluarkan' => '2026-11-15',
                'alamat_tujuan' => 'Camat Se-Kabupaten Ogan Komering Ilir',
                'perihal' => 'Jadwal Pelayanan Jemput Bola Perekaman KTP-el dan Aktivasi IKD Tingkat Kecamatan',
                'sifat' => 'Segera',
                'lampiran' => '1 (Satu) Lembar Jadwal',
                'status' => 'revisi',
                'catatan_revisi' => 'Mohon sesuaikan tanggal pelaksanaan Kecamatan Mesuji dan lampirkan rincian petugas operator SIAK per kecamatan sebelum diajukan kembali.',
                'tte_token_uuid' => null,
                'signed_by' => null,
                'signed_at' => null,
                'created_by' => $admin->id,
            ]
        );

        LogVerifikasi::where('naskah_type', SuratKeluar::class)->where('naskah_id', $sk2764Revisi->id)->delete();
        $sk2764Revisi->logVerifikasi()->createMany([
            [
                'tahap_verifikasi' => 'staf_admin',
                'status_aksi' => 'diajukan',
                'verifikator_id' => $admin->id,
                'catatan' => 'Konsep Surat Keluar 400/2764/disdukcapil/2026 diajukan ke Kasubbag Umpeg.',
                'waktu_verifikasi' => '2026-11-15 09:00:00',
            ],
            [
                'tahap_verifikasi' => 'kasubbag_umpeg',
                'status_aksi' => 'revisi',
                'verifikator_id' => $kasubbag->id,
                'catatan' => 'Mohon sesuaikan tanggal pelaksanaan Kecamatan Mesuji dan lampirkan rincian petugas operator SIAK per kecamatan sebelum diajukan kembali.',
                'waktu_verifikasi' => '2026-11-15 10:30:00',
            ],
        ]);

        // 5. Seed SPPD
        $sppd091 = Sppd::updateOrCreate(
            ['nomor_sppd' => '090/091/SPPD/DUKCAPIL/2026'],
            [
                'nomor_urut' => 91,
                'kode_klasifikasi_id' => $bidang800->id,
                'tanggal_surat' => '2026-11-12',
                'pegawai_id' => null,
                'nama_pegawai' => 'Drs. H. Ahmad Fauzi, M.Si',
                'nip_pegawai' => '197504122000031002',
                'jabatan_pegawai' => 'Kepala Bidang Pelayanan Pendaftaran Penduduk',
                'tanggal_berangkat' => '2026-11-18',
                'tanggal_kembali' => '2026-11-20',
                'daerah_tujuan' => 'Kantor Dinas Dukcapil Provinsi Sumatera Selatan - Palembang',
                'urusan_perjalanan' => 'Menghadiri Rapat Koordinasi Teknis Pemutakhiran Data Kependudukan Semester II serta Rekonsiliasi Blangko KTP Elektronik Tingkat Provinsi Sumatera Selatan Tahun 2026.',
                'status' => 'ttd_kadin',
                'tte_token_uuid' => '5c1e6b4a-7d2f-4e3a-9a18-3b6f0c2d8e91',
                'signed_by' => $kadin->id,
                'signed_at' => '2026-11-12 15:10:00',
                'created_by' => $admin->id,
            ]
        );

        // 6. Seed Berita Acara
        $ba028 = BeritaAcara::updateOrCreate(
            ['nomor_berita_acara' => '400/028/BA-SIAK/XI/2026'],
            [
                'nomor_urut' => 28,
                'kode_klasifikasi_id' => $bidang400->id,
                'tanggal_berita_acara' => '2026-11-11',
                'pihak_kedua' => 'Kantor Kecamatan Kayuagung (Camat Kayuagung)',
                'perihal' => 'Berita Acara Serah Terima (BAST) Distribusi 1.500 Keping Blangko KTP-el',
                'status' => 'ttd_kadin',
                'tte_token_uuid' => 'a4d2c8e1-9b30-4f12-8e71-60219c8a4b10',
                'signed_by' => $kadin->id,
                'signed_at' => '2026-11-11 16:00:00',
                'created_by' => $admin->id,
            ]
        );

        // 7. Seed Log Verifikasi Berjenjang (Staf Admin -> Kasubbag Umpeg -> Sekdin -> Kadin)
        LogVerifikasi::where('naskah_type', SuratKeluar::class)->where('naskah_id', $sk2763->id)->delete();

        $logs2763 = [
            [
                'tahap_verifikasi' => 'staf_admin',
                'status_aksi' => 'diajukan',
                'verifikator_id' => $admin->id,
                'catatan' => 'Konsep Surat Keluar 400/2763/disdukcapil/2026 diajukan ke Kasubbag Umpeg.',
                'checklist_pemeriksaan' => null,
                'waktu_verifikasi' => '2026-11-12 08:30:00',
            ],
            [
                'tahap_verifikasi' => 'kasubbag_umpeg',
                'status_aksi' => 'valid_kasubbag',
                'verifikator_id' => $kasubbag->id,
                'catatan' => 'Kode klasifikasi 400, lampiran, dan redaksi surat telah sesuai standar TNDE.',
                'checklist_pemeriksaan' => ['kode_bidang' => true, 'lampiran' => true, 'redaksi' => true],
                'waktu_verifikasi' => '2026-11-12 09:45:00',
            ],
            [
                'tahap_verifikasi' => 'sekretaris_dinas',
                'status_aksi' => 'valid_sekdin',
                'verifikator_id' => $sekdin->id,
                'catatan' => 'Diparaf koordinasi dan diteruskan ke Kepala Dinas untuk otorisasi TTE.',
                'checklist_pemeriksaan' => ['paraf_koordinasi' => true],
                'waktu_verifikasi' => '2026-11-12 11:30:00',
            ],
            [
                'tahap_verifikasi' => 'kepala_dinas',
                'status_aksi' => 'ttd_kadin',
                'verifikator_id' => $kadin->id,
                'catatan' => 'Sah & dibubuhkan Tanda Tangan Elektronik QR Code UUID.',
                'checklist_pemeriksaan' => ['otorisasi_tte_qr' => true],
                'waktu_verifikasi' => '2026-11-12 14:20:08',
            ],
        ];

        foreach ($logs2763 as $logRow) {
            $sk2763->logVerifikasi()->create($logRow);
        }

        // Log untuk surat 470/189/Disdukcapil-OKI/XI/2026 (posisi menunggu TTE Kadin)
        LogVerifikasi::where('naskah_type', SuratKeluar::class)->where('naskah_id', $sk189->id)->delete();
        $sk189->logVerifikasi()->createMany([
            [
                'tahap_verifikasi' => 'staf_admin',
                'status_aksi' => 'diajukan',
                'verifikator_id' => $admin->id,
                'catatan' => 'Konsep Surat Diajukan.',
                'waktu_verifikasi' => '2026-11-10 08:30:00',
            ],
            [
                'tahap_verifikasi' => 'kasubbag_umpeg',
                'status_aksi' => 'valid_kasubbag',
                'verifikator_id' => $kasubbag->id,
                'catatan' => 'Diverifikasi & Disetujui Kasubbag Umpeg.',
                'checklist_pemeriksaan' => ['kode_bidang' => true, 'lampiran' => true, 'redaksi' => true],
                'waktu_verifikasi' => '2026-11-10 09:15:00',
            ],
            [
                'tahap_verifikasi' => 'sekretaris_dinas',
                'status_aksi' => 'valid_sekdin',
                'verifikator_id' => $sekdin->id,
                'catatan' => 'Diparaf & Diteruskan ke Kadin.',
                'waktu_verifikasi' => '2026-11-10 10:00:00',
            ],
        ]);
    }
}
