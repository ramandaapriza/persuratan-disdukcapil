<?php

namespace Tests\Feature;

use App\Models\BeritaAcara;
use App\Models\KodeKlasifikasi;
use App\Models\LogVerifikasi;
use App\Models\Sppd;
use App\Models\SuratKeluar;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AlurVerifikasiDanTteEndToEndTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $kasubbag;
    private User $sekdin;
    private User $kadin;

    protected function setUp(): void
    {
        parent::setUp();

        KodeKlasifikasi::create([
            'kode_bidang' => '400',
            'nama_bidang' => 'Bidang Pelayanan Pencatatan Sipil',
            'keterangan' => 'Klasifikasi Pencatatan Sipil',
        ]);
        KodeKlasifikasi::create([
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
    }

    public function test_siklus_lengkap_surat_keluar_dari_registrasi_revisi_hingga_otorisasi_tte_qr_code(): void
    {
        // 1. Staf Admin mendaftarkan konsep Surat Keluar baru (Kode Bidang 400)
        $this->actingAs($this->admin)
            ->post('/registrasi-surat/surat-keluar', [
                'nomor_urut' => 2770,
                'kode_bidang' => '400',
                'tanggal_dikeluarkan' => '2026-11-24',
                'alamat_tujuan' => 'Direktorat Jenderal Dukcapil Kemendagri RI',
                'perihal' => 'Laporan Rekonsiliasi Data SIAK Terpusat Semester II',
                'sifat' => 'Penting',
                'lampiran' => '1 (Satu) Berkas',
            ])
            ->assertRedirect(route('registrasi.surat'))
            ->assertSessionHas('status');

        $sk = SuratKeluar::where('nomor_surat', '400/2770/disdukcapil/2026')->firstOrFail();
        $this->assertSame('draf', $sk->status);
        $this->assertDatabaseHas('log_verifikasi', [
            'naskah_type' => SuratKeluar::class,
            'naskah_id' => $sk->id,
            'tahap_verifikasi' => 'staf_admin',
            'status_aksi' => 'diajukan',
        ]);

        // 2. Kasubbag Umpeg mengembalikan konsep untuk revisi dengan catatan_revisi
        $this->actingAs($this->kasubbag)
            ->post("/verifikasi-hierarki/surat_keluar/{$sk->id}/revisi", [
                'catatan_revisi' => 'Mohon perbaiki lampiran rincian rekonsiliasi SIAK.',
            ])
            ->assertRedirect(route('verifikasi.hierarki'))
            ->assertSessionHas('status');

        $sk->refresh();
        $this->assertSame('revisi', $sk->status);
        $this->assertSame('Mohon perbaiki lampiran rincian rekonsiliasi SIAK.', $sk->catatan_revisi);
        $this->assertDatabaseHas('log_verifikasi', [
            'naskah_type' => SuratKeluar::class,
            'naskah_id' => $sk->id,
            'tahap_verifikasi' => 'kasubbag_umpeg',
            'status_aksi' => 'revisi',
        ]);

        // 3. Staf Admin memperbaiki & mengajukan ulang naskah revisi
        $this->actingAs($this->admin)
            ->put("/registrasi-surat/naskah/surat_keluar/{$sk->id}", [
                'kode_bidang' => '400',
                'nomor_urut' => 2770,
                'tanggal_dikeluarkan' => '2026-11-24',
                'alamat_tujuan' => 'Direktorat Jenderal Dukcapil Kemendagri RI',
                'perihal' => 'Laporan Rekonsiliasi Data SIAK Terpusat Semester II (Telah Direvisi)',
                'sifat' => 'Penting',
                'lampiran' => '2 (Dua) Berkas',
                'catatan_perbaikan' => 'Lampiran rincian rekonsiliasi SIAK telah dilengkapi.',
            ])
            ->assertRedirect(route('riwayat.naskah'))
            ->assertSessionHas('status');

        $sk->refresh();
        $this->assertSame('draf', $sk->status);
        $this->assertNull($sk->catatan_revisi);

        // 4. Kasubbag Umpeg menyetujui Tahap 1 -> status naik ke valid_kasubbag
        $this->actingAs($this->kasubbag)
            ->post("/verifikasi-hierarki/surat_keluar/{$sk->id}/setujui", [
                'catatan' => 'Klasifikasi 400 dan lampiran sudah lengkap.',
                'checklist' => [
                    'kode_klasifikasi' => '1',
                    'kelengkapan_lampiran' => '1',
                    'ketepatan_redaksi' => '1',
                ],
            ])
            ->assertRedirect(route('verifikasi.hierarki'))
            ->assertSessionHas('status');

        $sk->refresh();
        $this->assertSame('valid_kasubbag', $sk->status);
        $this->assertDatabaseHas('log_verifikasi', [
            'naskah_type' => SuratKeluar::class,
            'naskah_id' => $sk->id,
            'tahap_verifikasi' => 'kasubbag_umpeg',
            'status_aksi' => 'valid_kasubbag',
        ]);

        // 5. Sekretaris Dinas menyetujui Tahap 2 -> status naik ke valid_sekdin
        $this->actingAs($this->sekdin)
            ->post("/verifikasi-hierarki/surat_keluar/{$sk->id}/setujui", [
                'catatan' => 'Telah diparaf Sekdin, diteruskan untuk Tanda Tangan Elektronik Kadin.',
                'checklist' => [
                    'kode_klasifikasi' => '1',
                    'kelengkapan_lampiran' => '1',
                    'ketepatan_redaksi' => '1',
                ],
            ])
            ->assertRedirect(route('verifikasi.hierarki'))
            ->assertSessionHas('status');

        $sk->refresh();
        $this->assertSame('valid_sekdin', $sk->status);
        $this->assertDatabaseHas('log_verifikasi', [
            'naskah_type' => SuratKeluar::class,
            'naskah_id' => $sk->id,
            'tahap_verifikasi' => 'sekretaris_dinas',
            'status_aksi' => 'valid_sekdin',
        ]);

        // 6. Kepala Dinas mencoba membubuhkan TTE dengan PIN TTE salah -> ditolak
        $this->actingAs($this->kadin)
            ->from("/kadin/validasi?jenis=surat_keluar&id={$sk->id}")
            ->post("/kadin/validasi/surat_keluar/{$sk->id}/tte", [
                'pin_tte' => '000000',
                'catatan' => 'Percobaan PIN salah',
            ])
            ->assertSessionHas('error');

        $sk->refresh();
        $this->assertSame('valid_sekdin', $sk->status);
        $this->assertNull($sk->tte_token_uuid);

        // 7. Kepala Dinas membubuhkan TTE dengan PIN TTE benar -> sah berstatus ttd_kadin & QR SVG tampil
        $this->actingAs($this->kadin)
            ->post("/kadin/validasi/surat_keluar/{$sk->id}/tte", [
                'pin_tte' => '123456',
                'catatan' => 'Disahkan dengan Tanda Tangan Elektronik Kepala Dinas.',
            ])
            ->assertRedirect(route('kadin.validasi', ['jenis' => 'surat_keluar', 'id' => $sk->id]))
            ->assertSessionHas('status');

        $sk->refresh();
        $this->assertSame('ttd_kadin', $sk->status);
        $this->assertNotNull($sk->tte_token_uuid);
        $this->assertTrue(Str::isUuid($sk->tte_token_uuid));
        $this->assertSame($this->kadin->id, $sk->signed_by);
        $this->assertNotNull($sk->signed_at);
        $this->assertDatabaseHas('log_verifikasi', [
            'naskah_type' => SuratKeluar::class,
            'naskah_id' => $sk->id,
            'tahap_verifikasi' => 'kepala_dinas',
            'status_aksi' => 'ttd_kadin',
        ]);

        // Render halaman validasi Kadin & pastikan SVG QR Code serta UUID muncul
        $viewResp = $this->actingAs($this->kadin)
            ->get("/kadin/validasi?jenis=surat_keluar&id={$sk->id}");
        $viewResp->assertOk();
        $viewResp->assertSee($sk->tte_token_uuid);
        $viewResp->assertSee('<svg', false);
    }

    public function test_pengajuan_sppd_dan_berita_acara_hingga_otorisasi_tte_massal_oleh_kadin(): void
    {
        // 1. Staf Admin mengajukan konsep SPPD & Berita Acara
        $this->actingAs($this->admin)
            ->post('/registrasi-surat/sppd', [
                'nomor_urut' => 98,
                'nomor_sppd' => '800/098/SPPD/DUKCAPIL/2026',
                'kode_bidang' => '800',
                'tanggal_surat' => '2026-11-24',
                'nama_pegawai' => 'Hj. Siti Rahmawati, S.Sos., M.Si',
                'nip_pegawai' => '198002102006042008',
                'jabatan_pegawai' => 'Kasubbag Umum & Kepegawaian',
                'tanggal_berangkat' => '2026-11-26',
                'tanggal_kembali' => '2026-11-28',
                'daerah_tujuan' => 'Dinas Dukcapil Provinsi Sumatera Selatan - Palembang',
                'urusan_perjalanan' => 'Koordinasi Teknis Pengelolaan Arsip Persuratan Elektronik',
            ])
            ->assertRedirect(route('registrasi.surat'));

        $this->actingAs($this->admin)
            ->post('/registrasi-surat/berita-acara', [
                'nomor_urut' => 35,
                'nomor_berita_acara' => '400/035/BA-SIAK/XI/2026',
                'kode_bidang' => '400',
                'tanggal_berita_acara' => '2026-11-24',
                'pihak_kedua' => 'Kantor Kecamatan Kayuagung Kabupaten OKI',
                'perihal' => 'Berita Acara Serah Terima Blangko KTP Elektronik Triwulan IV',
            ])
            ->assertRedirect(route('registrasi.surat'));

        $sppd = Sppd::where('nomor_sppd', '800/098/SPPD/DUKCAPIL/2026')->firstOrFail();
        $ba = BeritaAcara::where('nomor_berita_acara', '400/035/BA-SIAK/XI/2026')->firstOrFail();

        // 2. Kasubbag menyetujui Tahap 1 untuk SPPD & Berita Acara
        $checklist = [
            'kode_klasifikasi' => '1',
            'kelengkapan_lampiran' => '1',
            'ketepatan_redaksi' => '1',
        ];
        $this->actingAs($this->kasubbag)
            ->post("/verifikasi-hierarki/sppd/{$sppd->id}/setujui", ['checklist' => $checklist])
            ->assertRedirect(route('verifikasi.hierarki'));
        $this->actingAs($this->kasubbag)
            ->post("/verifikasi-hierarki/berita_acara/{$ba->id}/setujui", ['checklist' => $checklist])
            ->assertRedirect(route('verifikasi.hierarki'));

        // 3. Sekdin menyetujui Tahap 2 untuk SPPD & Berita Acara
        $this->actingAs($this->sekdin)
            ->post("/verifikasi-hierarki/sppd/{$sppd->id}/setujui", ['checklist' => $checklist])
            ->assertRedirect(route('verifikasi.hierarki'));
        $this->actingAs($this->sekdin)
            ->post("/verifikasi-hierarki/berita_acara/{$ba->id}/setujui", ['checklist' => $checklist])
            ->assertRedirect(route('verifikasi.hierarki'));

        $this->assertSame('valid_sekdin', $sppd->fresh()->status);
        $this->assertSame('valid_sekdin', $ba->fresh()->status);

        // 4. Kadin mencoba TTE Massal dengan PIN salah -> ditolak
        $this->actingAs($this->kadin)
            ->from('/kadin')
            ->post('/kadin/tte-massal', [
                'pin_tte' => '999999',
                'items' => ["sppd_{$sppd->id}", "berita_acara_{$ba->id}"],
            ])
            ->assertRedirect('/kadin')
            ->assertSessionHas('error');

        $this->assertSame('valid_sekdin', $sppd->fresh()->status);
        $this->assertNull($sppd->fresh()->tte_token_uuid);

        // 5. Kadin mengeksekusi TTE Massal dengan PIN benar -> kedua dokumen sah ber-TTE UUID
        $this->actingAs($this->kadin)
            ->post('/kadin/tte-massal', [
                'pin_tte' => '123456',
                'items' => ["sppd_{$sppd->id}", "berita_acara_{$ba->id}"],
                'catatan' => 'Disahkan serentak melalui fitur TTE Massal Kepala Dinas.',
            ])
            ->assertRedirect(route('dashboard.kadin'))
            ->assertSessionHas('status');

        $sppd->refresh();
        $ba->refresh();

        $this->assertSame('ttd_kadin', $sppd->status);
        $this->assertTrue(Str::isUuid($sppd->tte_token_uuid));
        $this->assertSame('ttd_kadin', $ba->status);
        $this->assertTrue(Str::isUuid($ba->tte_token_uuid));
        $this->assertNotSame($sppd->tte_token_uuid, $ba->tte_token_uuid);
    }

    public function test_kadin_dapat_mengubah_pin_tte_mandiri_dan_mengembalikan_naskah_untuk_revisi(): void
    {
        // 1. Gagal ubah PIN TTE jika kredensial verifikasi (PIN/Password lama) salah
        $this->actingAs($this->kadin)
            ->from('/kadin')
            ->patch('/kadin/pin-tte', [
                'kredensial_verifikasi' => '000999',
                'pin_tte_baru' => '654321',
                'pin_tte_baru_confirmation' => '654321',
            ])
            ->assertRedirect('/kadin')
            ->assertSessionHas('error');

        $this->assertTrue(Hash::check('123456', $this->kadin->fresh()->pin_tte));

        // 2. Berhasil ubah PIN TTE jika kredensial verifikasi valid
        $this->actingAs($this->kadin)
            ->from('/kadin')
            ->patch('/kadin/pin-tte', [
                'kredensial_verifikasi' => '123456',
                'pin_tte_baru' => '654321',
                'pin_tte_baru_confirmation' => '654321',
            ])
            ->assertRedirect('/kadin')
            ->assertSessionHas('status');

        $this->assertTrue(Hash::check('654321', $this->kadin->fresh()->pin_tte));

        // 3. Kadin mengembalikan naskah valid_sekdin untuk revisi
        $klasifikasi = KodeKlasifikasi::where('kode_bidang', '00')->firstOrFail();
        $sk = SuratKeluar::create([
            'nomor_urut' => 2780,
            'kode_klasifikasi_id' => $klasifikasi->id,
            'tahun' => 2026,
            'nomor_surat' => '00/2780/disdukcapil/2026',
            'tanggal_dikeluarkan' => '2026-11-24',
            'alamat_tujuan' => 'BPKAD Kabupaten OKI',
            'perihal' => 'Pengajuan SPP-LS Belanja Pemeliharaan Jaringan SIAK',
            'sifat' => 'Penting',
            'lampiran' => '1 (Satu) Berkas',
            'status' => 'valid_sekdin',
            'created_by' => $this->admin->id,
        ]);

        $this->actingAs($this->kadin)
            ->post("/kadin/validasi/surat_keluar/{$sk->id}/revisi", [
                'catatan_revisi' => 'Lampirkan berita acara pemeriksaan barang sebelum ditandatangani.',
            ])
            ->assertRedirect(route('kadin.validasi'))
            ->assertSessionHas('status');

        $sk->refresh();
        $this->assertSame('revisi', $sk->status);
        $this->assertSame('Lampirkan berita acara pemeriksaan barang sebelum ditandatangani.', $sk->catatan_revisi);
        $this->assertDatabaseHas('log_verifikasi', [
            'naskah_type' => SuratKeluar::class,
            'naskah_id' => $sk->id,
            'tahap_verifikasi' => 'kepala_dinas',
            'status_aksi' => 'revisi',
        ]);
    }
}

