<?php

namespace Tests\Feature;

use App\Models\KodeKlasifikasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthAndRbacTest extends TestCase
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
            'pin_tte' => null,
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
            'pin_tte' => null,
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
            'pin_tte' => null,
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

    public function test_single_gate_login_menggunakan_nip_email_dan_no_hp_mengarahkan_sesuai_role(): void
    {
        // 1. Staf Admin login menggunakan NIP -> redirect ke '/'
        $respAdmin = $this->post('/login', [
            'kredensial' => $this->admin->nip,
            'password' => 'password123',
        ]);
        $respAdmin->assertRedirect('/');
        $this->assertAuthenticatedAs($this->admin);
        $this->post('/logout');

        // 2. Kasubbag Umpeg login menggunakan Email Resmi -> redirect ke '/verifikasi-hierarki?tahap=1'
        $respKasubbag = $this->post('/login', [
            'kredensial' => $this->kasubbag->email,
            'password' => 'password123',
        ]);
        $respKasubbag->assertRedirect('/verifikasi-hierarki?tahap=1');
        $this->assertAuthenticatedAs($this->kasubbag);
        $this->post('/logout');

        // 3. Sekretaris Dinas login menggunakan No. HP -> redirect ke '/verifikasi-hierarki?tahap=2'
        $respSekdin = $this->post('/login', [
            'kredensial' => $this->sekdin->no_hp,
            'password' => 'password123',
        ]);
        $respSekdin->assertRedirect('/verifikasi-hierarki?tahap=2');
        $this->assertAuthenticatedAs($this->sekdin);
        $this->post('/logout');

        // 4. Kepala Dinas login menggunakan NIP -> redirect ke '/kadin'
        $respKadin = $this->post('/login', [
            'kredensial' => $this->kadin->nip,
            'password' => 'password123',
        ]);
        $respKadin->assertRedirect('/kadin');
        $this->assertAuthenticatedAs($this->kadin);
    }

    public function test_login_ditolak_jika_password_salah_atau_akun_nonaktif(): void
    {
        // Skenario 1: Password salah
        $respWrongPass = $this->from('/login')->post('/login', [
            'kredensial' => $this->admin->nip,
            'password' => 'password-salah-999',
        ]);
        $respWrongPass->assertRedirect('/login');
        $respWrongPass->assertSessionHasErrors('password');
        $this->assertGuest();

        // Skenario 2: Akun berstatus nonaktif (is_active = false)
        $this->kasubbag->update(['is_active' => false]);

        $respInactive = $this->from('/login')->post('/login', [
            'kredensial' => $this->kasubbag->nip,
            'password' => 'password123',
        ]);
        $respInactive->assertRedirect('/login');
        $respInactive->assertSessionHasErrors('kredensial');
        $this->assertGuest();
    }

    public function test_logout_menghancurkan_sesi_dan_mengarahkan_ke_halaman_login(): void
    {
        $this->actingAs($this->admin);
        $this->assertAuthenticatedAs($this->admin);

        $response = $this->post('/logout');

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_proteksi_guest_wajib_redirect_ke_login_sedangkan_portal_verifikasi_tetap_publik(): void
    {
        $protectedRoutes = [
            '/',
            '/registrasi-surat',
            '/riwayat-naskah',
            '/admin/users',
            '/verifikasi-hierarki',
            '/kadin',
            '/kadin/validasi',
            '/kadin/disposisi',
            '/buku-besar',
        ];

        foreach ($protectedRoutes as $uri) {
            $this->get($uri)->assertRedirect(route('login'));
        }

        // Portal Verifikasi QR Publik wajib dapat diakses tanpa login (200 OK)
        $this->get('/verifikasi-dokumen')->assertOk();
    }

    public function test_isolasi_lintas_role_rbac_menolak_akses_tidak_sah(): void
    {
        // 1. Staf Admin ditolak mengakses modul Kadin & Verifikasi Hierarki
        $this->actingAs($this->admin);
        foreach (['/kadin', '/kadin/validasi', '/kadin/disposisi', '/verifikasi-hierarki'] as $forbiddenUri) {
            $resp = $this->get($forbiddenUri);
            $resp->assertRedirect('/');
            $resp->assertSessionHas('error');
        }

        // 2. Kasubbag ditolak mengakses Manajemen User, Registrasi Surat, & Modul Kadin
        $this->actingAs($this->kasubbag);
        foreach (['/admin/users', '/registrasi-surat', '/kadin'] as $forbiddenUri) {
            $resp = $this->get($forbiddenUri);
            $resp->assertRedirect('/verifikasi-hierarki?tahap=1');
            $resp->assertSessionHas('error');
        }

        // 3. Sekdin ditolak mengakses Manajemen User, Registrasi Surat, & Modul Kadin
        $this->actingAs($this->sekdin);
        foreach (['/admin/users', '/registrasi-surat', '/kadin'] as $forbiddenUri) {
            $resp = $this->get($forbiddenUri);
            $resp->assertRedirect('/verifikasi-hierarki?tahap=2');
            $resp->assertSessionHas('error');
        }

        // 4. Kepala Dinas ditolak mengakses Manajemen User, Registrasi Surat, & Verifikasi Hierarki
        $this->actingAs($this->kadin);
        foreach (['/admin/users', '/registrasi-surat', '/verifikasi-hierarki'] as $forbiddenUri) {
            $resp = $this->get($forbiddenUri);
            $resp->assertRedirect('/kadin');
            $resp->assertSessionHas('error');
        }
    }
}

