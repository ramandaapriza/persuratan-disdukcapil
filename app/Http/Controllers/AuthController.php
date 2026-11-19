<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman Single Gate Login.
     * Jika pengguna sudah terautentikasi, arahkan ke halaman utama sesuai role.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            session(['active_role' => $user->role]);

            return redirect(self::redirectPathForRole($user->role));
        }

        return view('login');
    }

    /**
     * Memproses autentikasi Multi-Identifier Single Gate (NIP, Email Resmi, atau No. HP).
     */
    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'kredensial' => ['required', 'string'],
                'password' => ['required', 'string'],
            ],
            [
                'kredensial.required' => 'NIP, Email Resmi, atau Nomor HP terdaftar wajib diisi.',
                'password.required' => 'Kata sandi (password) akun wajib diisi.',
            ]
        );

        $identifier = trim($validated['kredensial']);
        $password = $validated['password'];

        $user = User::query()
            ->where('nip', $identifier)
            ->orWhere('email', $identifier)
            ->orWhere('no_hp', $identifier)
            ->first();

        if (! $user) {
            return back()
                ->withErrors([
                    'kredensial' => 'Kredensial (NIP / Email Resmi / No. HP) tidak ditemukan dalam database kepegawaian Disdukcapil OKI.',
                ])
                ->withInput($request->only('kredensial', 'remember'));
        }

        if (! $user->is_active) {
            return back()
                ->withErrors([
                    'kredensial' => 'Akun pegawai Anda saat ini berstatus nonaktif. Silakan hubungi Administrator Subbag Umpeg.',
                ])
                ->withInput($request->only('kredensial', 'remember'));
        }

        if (! Hash::check($password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Kata sandi yang Anda masukkan tidak sesuai dengan kredensial pegawai.',
                ])
                ->withInput($request->only('kredensial', 'remember'));
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();
        session(['active_role' => $user->role]);

        return redirect(self::redirectPathForRole($user->role))
            ->with('status', 'Autentikasi berhasil. Selamat bertugas, ' . $user->nama_lengkap . ' (' . $user->jabatan . ').');
    }

    /**
     * Mengakhiri sesi autentikasi pengguna dan mengembalikan ke halaman login.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('status', 'Anda telah berhasil keluar dari sistem E-Surat Disdukcapil OKI.');
    }

    /**
     * Menentukan URL tujuan utama berdasarkan role RBAC pengguna.
     */
    public static function redirectPathForRole(string $role): string
    {
        return match ($role) {
            User::ROLE_KADIN => '/kadin',
            User::ROLE_KASUBBAG => '/verifikasi-hierarki?tahap=1',
            User::ROLE_SEKDIN => '/verifikasi-hierarki?tahap=2',
            default => '/',
        };
    }
}
