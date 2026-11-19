<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Memeriksa otorisasi Role-Based Access Control (RBAC) pengguna yang sedang login.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Sesi autentikasi diperlukan. Silakan masuk menggunakan kredensial resmi Anda.');
        }

        /** @var User $user */
        $user = Auth::user();

        if (! $user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors(['kredensial' => 'Akun pegawai Anda telah dinonaktifkan oleh Administrator.']);
        }

        // Pastikan session active_role selalu sinkron dengan akun database yang sedang login
        session(['active_role' => $user->role]);

        // Normalisasi daftar role yang diizinkan
        $allowedRoles = [];
        foreach ($roles as $roleGroup) {
            foreach (explode(',', $roleGroup) as $r) {
                $trimmed = trim($r);
                if ($trimmed !== '') {
                    $allowedRoles[] = $trimmed;
                }
            }
        }

        if (! empty($allowedRoles) && ! in_array($user->role, $allowedRoles, true)) {
            $homePath = AuthController::redirectPathForRole($user->role);

            return redirect($homePath)->with(
                'error',
                'Akses Ditolak (RBAC): Jabatan Anda (' . $user->jabatan . ') tidak memiliki otoritas untuk mengakses halaman tersebut.'
            );
        }

        return $next($request);
    }
}
