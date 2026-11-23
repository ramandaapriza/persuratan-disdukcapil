<?php

namespace Tests\Feature;

use App\Models\BeritaAcara;
use App\Models\KodeKlasifikasi;
use App\Models\Sppd;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerifikasiPublikDanBukuBesarTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $kasubbag;
    private User $sekdin;
    private User $kadin;
    private SuratKeluar $skSigned;
    private SuratKeluar $skDraft;

    protected function setUp(): void
    {
        parent::setUp();

        $bidang400 = KodeKlasifikasi::create([
            'kode_bidang' => '400',
            'nama_bidang' => 'Bidang Pelayanan Pencatatan Sipil',
            'keterangan' => 'Klasifikasi Pencatatan Sipil',
        ]);
        $bidang800 = KodeKlasifikasi::create([
            'kode_bidang' => '800',
            'nama_bidang' => 'Subbagian Umum dan Kepegawaian',
            'keterangan' => 'Klasifikasi Kepegawaian & SPPD',
        ]);
        KodeKlasifikasi::create([
            'kode_bidang' => '00',
            'nama_bidang' => 'Subbagian Perencanaan dan Keuangan',
            'keterangan' => 'Klasifikasi Keuangan & Umum',
        ]);

        $this->admin = User::create([
            'nip' => '199506182020121009',
            'nama_lengkap' => 'Rizky Pratama, A.Md',
            'jabatan' => 'Staf Administrasi Persuratan',
            'pangkat_golongan' => 'Pengatur (II/c)',
            'no_hp' => '081271000004',
            'email' => 'admin.umpeg@kaboki.go.id',
            'role' => User::ROLE_ADMIN,
            'password' => 'password123',
            'is_active' => true,
        ]);

        $this->kasubbag = User::create([
            'nip' => '198002102006042008',
            'nama_lengkap' => 'Hj. Siti Rahmawati, S.Sos., M.Si',
            'jabatan' => 'Kasubbag Umum & Kepegawaian',
            'pangkat_golongan' => 'Penata Tk.I (III/d)',
            'no_hp' => '081271000003',
            'email' => 'siti.rahmawati@kaboki.go.id',
            'role' => User::ROLE_KASUBBAG,
            'password' => 'password123',
            'is_active' => true,
        ]);

        $this->sekdin = User::create([
            'nip' => '197605222002121003',
            'nama_lengkap' => 'H. Ahmad Fauzi, S.STP., M.Si',
            'jabatan' => 'Sekretaris Dinas',
            'pangkat_golongan' => 'Pembina (IV/a)',
            'no_hp' => '081271000002',
            'email' => 'ahmad.fauzi@kaboki.go.id',
            'role' => User::ROLE_SEKDIN,
            'password' => 'password123',
            'is_active' => true,
        ]);

        $this->kadin = User::create([
            'nip' => '197108141998031004',
            'nama_lengkap' => 'Drs. H. Hendra Suryadi, M.Si',
            'jabatan' => 'Kepala Dinas Dukcapil Kab. OKI',
            'pangkat_golongan' => 'Pembina Utama Muda (IV/c)',
            'no_hp' => '081271000001',
            'email' => 'hendra.suryadi@kaboki.go.id',
            'role' => User::ROLE_KADIN,
            'password' => 'password123',
            'pin_tte' => '123456',
            'is_active' => true,
        ]);

        // Dokumen Surat Keluar yang sudah sah ber-TTE
        $this->skSigned = SuratKeluar::create([
            'nomor_urut' => 2758,
            'kode_klasifikasi_id' => $bidang400->id,
            'tahun' => 2026,
            'nomor_surat' => '400/2758/disdukcapil/2026',
            'tanggal_dikeluarkan' => '2026-11-20',
            'alamat_tujuan' => 'Direktorat Jenderal Dukcapil Kemendagri RI',
            'perihal' => 'Koordinasi Integrasi SIAK Terpusat Kabupaten OKI',
            'sifat' => 'Penting',
            'lampiran' => '1 (Satu) Berkas',
            'status' => 'ttd_kadin',
            'tte_token_uuid' => 'e8b7a9c2-4f1d-4a9b-8c3e-9102f84a712b',
            'signed_by' => $this->kadin->id,
            'signed_at' => now(),
            'created_by' => $this->admin->id,
        ]);

        $this->skSigned->logVerifikasi()->create([
            'tahap_verifikasi' => 'kepala_dinas',
            'status_aksi' => 'ttd_kadin',
            'verifikator_id' => $this->kadin->id,
            'catatan' => 'Disahkan dengan Tanda Tangan Elektronik QR Code.',
            'waktu_verifikasi' => now(),
        ]);

        // Dokumen Surat Keluar yang masih berstatus draf (belum TTE)
        $this->skDraft = SuratKeluar::create([
            'nomor_urut' => 2759,
            'kode_klasifikasi_id' => $bidang400->id,
            'tahun' => 2026,
            'nomor_surat' => '400/2759/disdukcapil/2026',
            'tanggal_dikeluarkan' => '2026-11-21',
            'alamat_tujuan' => 'Bupati Ogan Komering Ilir',
            'perihal' => 'Laporan Bulanan Pelayanan Akta Kelahiran',
            'sifat' => 'Biasa',
            'lampiran' => '1 (Satu) Berkas',
            'status' => 'draf',
            'created_by' => $this->admin->id,
        ]);

        // Tambahan data Surat Masuk, SPPD, & Berita Acara untuk Buku Besar
        SuratMasuk::create([
            'nomor_urut_agenda' => '0151',
            'tanggal_diterima' => '2026-11-20',
            'pengirim' => 'Kementerian Dalam Negeri RI',
            'tanggal_surat' => '2026-11-18',
            'nomor_surat' => '470/4412/SJ',
            'perihal' => 'Pedoman Pemutakhiran Data Kependudukan Semester II',
            'sifat_surat' => 'Penting',
            'kode_klasifikasi_id' => $bidang400->id,
            'status_kenaikan' => 'diterima_ajudan',
            'status' => 'diproses',
            'created_by' => $this->admin->id,
        ]);

        Sppd::create([
            'nomor_urut' => 91,
            'kode_klasifikasi_id' => $bidang800->id,
            'nomor_sppd' => '800/091/SPPD/DUKCAPIL/2026',
            'tanggal_surat' => '2026-11-20',
            'nama_pegawai' => 'H. Ahmad Fauzi, S.STP., M.Si',
            'nip_pegawai' => '197605222002121003',
            'jabatan_pegawai' => 'Sekretaris Dinas',
            'tanggal_berangkat' => '2026-11-22',
            'tanggal_kembali' => '2026-11-24',
            'daerah_tujuan' => 'Palembang',
            'urusan_perjalanan' => 'Rapat Koordinasi Dukcapil se-Sumatera Selatan',
            'status' => 'ttd_kadin',
            'tte_token_uuid' => 'f4a1c3d5-8b2e-4f7a-9c6b-334455667788',
            'signed_by' => $this->kadin->id,
            'signed_at' => now(),
            'created_by' => $this->admin->id,
        ]);

        BeritaAcara::create([
            'nomor_urut' => 28,
            'kode_klasifikasi_id' => $bidang400->id,
            'nomor_berita_acara' => '400/028/BA-SIAK/XI/2026',
            'tanggal_berita_acara' => '2026-11-20',
            'pihak_kedua' => 'Kecamatan Kayuagung',
            'perihal' => 'Berita Acara Serah Terima Keping KTP-el',
            'status' => 'ttd_kadin',
            'tte_token_uuid' => 'a1b2c3d4-e5f6-4a7b-8c9d-001122334455',
            'signed_by' => $this->kadin->id,
            'signed_at' => now(),
            'created_by' => $this->admin->id,
        ]);
    }

    public function test_portal_verifikasi_publik_menampilkan_status_sah_untuk_token_uuid_dan_nomor_surat_valid(): void
    {
        // 1. Akses publik menggunakan parameter ?token={uuid_valid}
        $respUuid = $this->get('/verifikasi-dokumen?token=' . $this->skSigned->tte_token_uuid);
        $respUuid->assertOk();
        $respUuid->assertSee('DOKUMEN ASLI &amp; TERVERIFIKASI SAH', false);
        $respUuid->assertSee($this->skSigned->nomor_surat);
        $respUuid->assertSee($this->kadin->nama_lengkap);
        $respUuid->assertSee('<svg', false);

        // 2. Akses publik menggunakan pencarian nomor surat resmi
        $respNomor = $this->get('/verifikasi-dokumen?token=' . urlencode($this->skSigned->nomor_surat));
        $respNomor->assertOk();
        $respNomor->assertSee('DOKUMEN ASLI &amp; TERVERIFIKASI SAH', false);
        $respNomor->assertSee($this->skSigned->tte_token_uuid);
    }

    public function test_portal_verifikasi_publik_menampilkan_peringatan_merah_untuk_token_palsu_atau_naskah_draf(): void
    {
        // 1. Token UUID palsu / tidak terdaftar
        $respFake = $this->get('/verifikasi-dokumen?token=uuid-palsu-tidak-terdaftar-000');
        $respFake->assertOk();
        $respFake->assertSee('DOKUMEN TIDAK DITEMUKAN / TIDAK TERVERIFIKASI');

        // 2. Nomor surat ditemukan tetapi masih berstatus 'draf' (belum disahkan dengan TTE Kadin)
        $respDraft = $this->get('/verifikasi-dokumen?token=' . urlencode($this->skDraft->nomor_surat));
        $respDraft->assertOk();
        $respDraft->assertSee('DOKUMEN TIDAK DITEMUKAN / TIDAK TERVERIFIKASI');
        $respDraft->assertSee('BELUM memiliki pengesahan Tanda Tangan Elektronik');
    }

    public function test_unduh_salinan_resmi_pdf_a4_menghasilkan_binary_pdf_valid_dan_menolak_token_palsu(): void
    {
        // 1. Unduh PDF A4 untuk token valid
        $respPdf = $this->get('/verifikasi-dokumen/unduh/' . $this->skSigned->tte_token_uuid);
        $respPdf->assertOk();
        $this->assertStringContainsString('application/pdf', (string) $respPdf->headers->get('content-type'));
        $this->assertStringStartsWith('%PDF-', (string) $respPdf->getContent());

        // 2. Token tidak valid mengembalikan 404 Not Found
        $this->get('/verifikasi-dokumen/unduh/token-tidak-valid-999')->assertNotFound();
    }

    public function test_buku_besar_dapat_diakses_keempat_role_beserta_filter_dan_ekspor_excel_serta_pdf(): void
    {
        // 1. Akses /buku-besar oleh keempat role (admin, kasubbag, sekdin, kadin)
        foreach ([$this->admin, $this->kasubbag, $this->sekdin, $this->kadin] as $actor) {
            $resp = $this->actingAs($actor)->get('/buku-besar');
            $resp->assertOk();
            $resp->assertSee('400/2758/disdukcapil/2026');
            $resp->assertSee('800/091/SPPD/DUKCAPIL/2026');
        }

        // 2. Uji filter jenis naskah & kode bidang pada /buku-besar
        $respFiltered = $this->actingAs($this->admin)
            ->get('/buku-besar?jenis=surat_keluar&kode_bidang=400&status=ttd_kadin');
        $respFiltered->assertOk();
        $respFiltered->assertSee('400/2758/disdukcapil/2026');
        $respFiltered->assertDontSee('800/091/SPPD/DUKCAPIL/2026');

        // 3. Uji Ekspor Excel CSV UTF-8 BOM (/buku-besar/export-excel)
        $respExcel = $this->actingAs($this->kadin)->get('/buku-besar/export-excel');
        $respExcel->assertOk();
        $csvContent = $respExcel->streamedContent();
        $this->assertStringStartsWith("\xEF\xBB\xBF", $csvContent);
        $this->assertStringContainsString('400/2758/disdukcapil/2026', $csvContent);
        $this->assertStringContainsString($this->skSigned->tte_token_uuid, $csvContent);

        // 4. Uji Cetak Rekap Laporan PDF A4 Landscape (/buku-besar/export-pdf)
        $respPdf = $this->actingAs($this->kadin)->get('/buku-besar/export-pdf');
        $respPdf->assertOk();
        $this->assertStringContainsString('application/pdf', (string) $respPdf->headers->get('content-type'));
        $this->assertStringStartsWith('%PDF-', (string) $respPdf->getContent());
    }
}

