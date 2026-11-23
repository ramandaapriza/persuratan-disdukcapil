<?php

namespace Tests\Feature;

use App\Models\DisposisiSuratMasuk;
use App\Models\KodeKlasifikasi;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SuratMasukDanDisposisiTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
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

    public function test_admin_mengagendakan_surat_masuk_menaikkan_ke_ajudan_dan_kadin_menyimpan_disposisi(): void
    {
        // 1. Staf Admin mencatat agenda Surat Masuk baru (belum langsung naik ke ajudan)
        $this->actingAs($this->admin)
            ->post('/registrasi-surat/surat-masuk', [
                'nomor_urut_agenda' => '0160',
                'tanggal_diterima' => '2026-11-24',
                'pengirim' => 'Sekretariat Daerah Kabupaten Ogan Komering Ilir',
                'tanggal_surat' => '2026-11-23',
                'nomor_surat' => '005/912/SETDA-OKI/2026',
                'perihal' => 'Undangan Rapat Koordinasi Evaluasi Pelayanan Publik Kabupaten OKI',
                'sifat_surat' => 'Segera',
                'kode_bidang' => '800',
                'langsung_naik_ajudan' => 0,
            ])
            ->assertRedirect(route('registrasi.surat'))
            ->assertSessionHas('status');

        $sm = SuratMasuk::where('nomor_urut_agenda', '0160')->firstOrFail();
        $this->assertSame('belum_naik', $sm->status_kenaikan);
        $this->assertSame('baru', $sm->status);

        // 2. Staf Admin menaikkan Surat Masuk ke Ajudan Kepala Dinas
        $this->actingAs($this->admin)
            ->from('/riwayat-naskah')
            ->patch("/surat-masuk/{$sm->id}/naik-ajudan")
            ->assertRedirect('/riwayat-naskah')
            ->assertSessionHas('status');

        $sm->refresh();
        $this->assertSame('diterima_ajudan', $sm->status_kenaikan);
        $this->assertSame('diproses', $sm->status);
        $this->assertSame($this->admin->id, $sm->ajudan_id);
        $this->assertNotNull($sm->tanggal_naik_kadin);

        // 3. Kepala Dinas membuka halaman /kadin/disposisi & menyimpan instruksi disposisi
        $this->actingAs($this->kadin)
            ->get('/kadin/disposisi')
            ->assertOk()
            ->assertSee('005/912/SETDA-OKI/2026');

        $this->actingAs($this->kadin)
            ->post("/kadin/disposisi/{$sm->id}", [
                'kode_bidang' => '800',
                'diserahkan_kepada_unit' => 'Subbagian Umum & Kepegawaian (Kode 800)',
                'nama_pegawai_penerima' => 'Hj. Siti Rahmawati, S.Sos., M.Si',
                'tanggal_menerima' => '2026-11-24',
                'sifat_disposisi' => 'Segera',
                'instruksi_cepat' => ['Tindak Lanjuti', 'Siapkan Konsep/Bahan'],
                'catatan_kadin' => 'Siapkan bahan paparan capaian pelayanan Disdukcapil OKI.',
                'status_disposisi' => 'diproses',
            ])
            ->assertRedirect(route('kadin.disposisi', ['surat_masuk_id' => $sm->id]))
            ->assertSessionHas('status');

        $disposisi = DisposisiSuratMasuk::where('surat_masuk_id', $sm->id)->firstOrFail();
        $this->assertSame($this->kadin->id, $disposisi->didisposisi_oleh);
        $this->assertSame('diproses', $disposisi->status_disposisi);
        $this->assertContains('Tindak Lanjuti', $disposisi->instruksi_cepat);

        // 4. Kepala Dinas memperbarui status tindak lanjut disposisi menjadi 'selesai'
        $this->actingAs($this->kadin)
            ->from('/kadin/disposisi')
            ->patch("/kadin/disposisi/{$disposisi->id}/status", [
                'status_disposisi' => 'selesai',
            ])
            ->assertRedirect('/kadin/disposisi')
            ->assertSessionHas('status');

        $this->assertSame('selesai', $disposisi->fresh()->status_disposisi);
        $this->assertSame('selesai', $sm->fresh()->status);
    }

    public function test_crud_manajemen_akun_pegawai_dan_proteksi_penonaktifan_akun_sendiri(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin/users')
            ->assertOk()
            ->assertSee($this->admin->nama_lengkap);

        // 1. Tambah akun pegawai baru
        $this->actingAs($this->admin)
            ->post('/admin/users', [
                'nip' => '198811122015032005',
                'nama_lengkap' => 'Dewi Sartika, S.Kom',
                'jabatan' => 'Analis Sistem Informasi Kependudukan',
                'pangkat_golongan' => 'Penata Muda Tk.I (III/b)',
                'email' => 'dewi.sartika@kaboki.go.id',
                'no_hp' => '081271009988',
                'role' => User::ROLE_KASUBBAG,
                'password' => 'dewi2026',
            ])
            ->assertRedirect(route('admin.users'))
            ->assertSessionHas('status');

        $newUser = User::where('nip', '198811122015032005')->firstOrFail();
        $this->assertTrue($newUser->is_active);
        $this->assertTrue(Hash::check('dewi2026', $newUser->password));

        // 2. Edit profil & role pegawai
        $this->actingAs($this->admin)
            ->put("/admin/users/{$newUser->id}", [
                'nip' => '198811122015032005',
                'nama_lengkap' => 'Dewi Sartika, S.Kom., M.T',
                'jabatan' => 'Plt. Sekretaris Dinas',
                'pangkat_golongan' => 'Penata (III/c)',
                'email' => 'dewi.sartika@kaboki.go.id',
                'no_hp' => '081271009988',
                'role' => User::ROLE_SEKDIN,
            ])
            ->assertRedirect(route('admin.users'))
            ->assertSessionHas('status');

        $this->assertSame('Dewi Sartika, S.Kom., M.T', $newUser->fresh()->nama_lengkap);
        $this->assertSame(User::ROLE_SEKDIN, $newUser->fresh()->role);

        // 3. Reset password pegawai
        $this->actingAs($this->admin)
            ->patch("/admin/users/{$newUser->id}/reset-password", [
                'new_password' => 'resetpass8899',
            ])
            ->assertRedirect(route('admin.users'))
            ->assertSessionHas('status');

        $this->assertTrue(Hash::check('resetpass8899', $newUser->fresh()->password));

        // 4. Toggle status aktif pegawai lain (nonaktifkan lalu aktifkan kembali)
        $this->actingAs($this->admin)
            ->patch("/admin/users/{$newUser->id}/toggle-active")
            ->assertRedirect(route('admin.users'));
        $this->assertFalse($newUser->fresh()->is_active);

        $this->actingAs($this->admin)
            ->patch("/admin/users/{$newUser->id}/toggle-active")
            ->assertRedirect(route('admin.users'));
        $this->assertTrue($newUser->fresh()->is_active);

        // 5. Proteksi keamanan: Admin tidak boleh menonaktifkan akunnya sendiri yang sedang login
        $this->actingAs($this->admin)
            ->from('/admin/users')
            ->patch("/admin/users/{$this->admin->id}/toggle-active")
            ->assertRedirect('/admin/users')
            ->assertSessionHas('error');

        $this->assertTrue($this->admin->fresh()->is_active);
    }
}

