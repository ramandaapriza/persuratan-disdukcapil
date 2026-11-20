<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrasiNaskahController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiHierarkiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. Rute Publik (Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/verifikasi-dokumen', function () {
    return view('verifikasi-qr');
})->name('verifikasi.dokumen');

/*
|--------------------------------------------------------------------------
| 2. Rute Logout (Mendukung GET & POST untuk Tautan Sidebar & Form)
|--------------------------------------------------------------------------
*/
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 3. Rute Internal Terproteksi (Single Gate RBAC Middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Rute khusus Staf Admin Subbag Umpeg (Tahap 1: Dashboard, Registrasi Naskah, Revisi, & Manajemen User)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.admin');

        // Registrasi & Agenda Naskah Dinas (Surat Keluar, SPPD, Berita Acara, Surat Masuk)
        Route::get('/registrasi-surat', [RegistrasiNaskahController::class, 'index'])->name('registrasi.surat');
        Route::post('/registrasi-surat/surat-keluar', [RegistrasiNaskahController::class, 'storeSuratKeluar'])->name('registrasi.surat-keluar.store');
        Route::post('/registrasi-surat/sppd', [RegistrasiNaskahController::class, 'storeSppd'])->name('registrasi.sppd.store');
        Route::post('/registrasi-surat/berita-acara', [RegistrasiNaskahController::class, 'storeBeritaAcara'])->name('registrasi.berita-acara.store');
        Route::post('/registrasi-surat/surat-masuk', [RegistrasiNaskahController::class, 'storeSuratMasuk'])->name('registrasi.surat-masuk.store');

        // Riwayat & Pantauan Naskah Dinas (Pelacakan Status Hierarki, Log Verifikasi, & Edit Revisi/Draf)
        Route::get('/riwayat-naskah', [RegistrasiNaskahController::class, 'riwayat'])->name('riwayat.naskah');
        Route::put('/registrasi-surat/naskah/{jenis}/{id}', [RegistrasiNaskahController::class, 'updateNaskah'])->name('registrasi.naskah.update');
        Route::patch('/surat-masuk/{suratMasuk}/naik-ajudan', [RegistrasiNaskahController::class, 'naikkanSuratMasuk'])->name('surat-masuk.naik-ajudan');

        // Manajemen Akun Pegawai (RBAC)
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::patch('/admin/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset-password');
        Route::patch('/admin/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('admin.users.toggle-active');
    });

    // Rute khusus Kasubbag Umpeg & Sekretaris Dinas (Verifikator Hierarki Tahap 1 & Tahap 2)
    Route::middleware(['role:kasubbag,sekdin'])->group(function () {
        Route::get('/verifikasi-hierarki', [VerifikasiHierarkiController::class, 'index'])->name('verifikasi.hierarki');
        Route::post('/verifikasi-hierarki/{jenis}/{id}/setujui', [VerifikasiHierarkiController::class, 'approve'])->name('verifikasi.hierarki.approve');
        Route::post('/verifikasi-hierarki/{jenis}/{id}/revisi', [VerifikasiHierarkiController::class, 'revisi'])->name('verifikasi.hierarki.revisi');
    });

    // Rute khusus Kepala Dinas (Kadin)
    Route::middleware(['role:kadin'])->group(function () {
        Route::get('/kadin', function () {
            return view('dashboard-kadin');
        })->name('dashboard.kadin');

        Route::get('/kadin/validasi', function () {
            return view('validasi-ttd');
        })->name('kadin.validasi');

        Route::get('/kadin/disposisi', function () {
            return view('disposisi-masuk');
        })->name('kadin.disposisi');
    });

    // Rute bersama seluruh aktor internal terautentikasi (Admin, Kasubbag, Sekdin, Kadin)
    Route::middleware(['role:admin,kasubbag,sekdin,kadin'])->group(function () {
        Route::get('/buku-besar', function () {
            return view('buku-besar');
        })->name('buku.besar');
    });
});
