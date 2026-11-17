<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

if (!function_exists('resolveActiveRole')) {
    function resolveActiveRole(Request $request, string $defaultRole = 'admin'): string
    {
        $allowedRoles = ['admin', 'kasubbag', 'sekdin', 'kadin'];
        $requestedRole = $request->query('role');

        if ($requestedRole && in_array($requestedRole, $allowedRoles, true)) {
            try {
                session(['active_role' => $requestedRole]);
            } catch (\Throwable $e) {
            }
            return $requestedRole;
        }

        try {
            $sessionRole = session('active_role');
            if ($sessionRole && in_array($sessionRole, $allowedRoles, true)) {
                return $sessionRole;
            }
        } catch (\Throwable $e) {
        }

        return $defaultRole;
    }
}

Route::get('/switch-role/{role}', function (Request $request, string $role) {
    $allowedRoles = ['admin', 'kasubbag', 'sekdin', 'kadin'];
    if (!in_array($role, $allowedRoles, true)) {
        $role = 'admin';
    }

    try {
        session(['active_role' => $role]);
    } catch (\Throwable $e) {
    }

    $redirect = $request->query('redirect');
    if ($redirect && str_starts_with($redirect, '/')) {
        return redirect($redirect . '?role=' . $role);
    }

    return match ($role) {
        'kadin' => redirect('/kadin?role=kadin'),
        'kasubbag' => redirect('/verifikasi-hierarki?role=kasubbag'),
        'sekdin' => redirect('/verifikasi-hierarki?role=sekdin'),
        default => redirect('/?role=admin'),
    };
});

Route::get('/', function (Request $request) {
    return view('dashboard', ['activeRole' => resolveActiveRole($request, 'admin')]);
});

Route::get('/kadin', function (Request $request) {
    return view('dashboard-kadin', ['activeRole' => resolveActiveRole($request, 'kadin')]);
});

Route::get('/kadin/validasi', function (Request $request) {
    return view('validasi-ttd', ['activeRole' => resolveActiveRole($request, 'kadin')]);
});

Route::get('/kadin/disposisi', function (Request $request) {
    return view('disposisi-masuk', ['activeRole' => resolveActiveRole($request, 'kadin')]);
});

Route::get('/registrasi-surat', function (Request $request) {
    return view('registrasi-surat', ['activeRole' => resolveActiveRole($request, 'admin')]);
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin/users', function (Request $request) {
    return view('manajemen-user', ['activeRole' => resolveActiveRole($request, 'admin')]);
});

Route::get('/verifikasi-dokumen', function () {
    return view('verifikasi-qr');
});

Route::get('/buku-besar', function (Request $request) {
    return view('buku-besar', ['activeRole' => resolveActiveRole($request, 'admin')]);
});

Route::get('/verifikasi-hierarki', function (Request $request) {
    return view('verifikasi-hierarki', ['activeRole' => resolveActiveRole($request, 'kasubbag')]);
});
