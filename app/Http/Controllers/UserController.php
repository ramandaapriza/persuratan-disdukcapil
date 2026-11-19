<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Menampilkan halaman Manajemen Akun Pegawai (RBAC).
     */
    public function index(): View
    {
        $users = User::query()
            ->orderByRaw("CASE role WHEN 'kadin' THEN 1 WHEN 'sekdin' THEN 2 WHEN 'kasubbag' THEN 3 ELSE 4 END")
            ->orderBy('id')
            ->get();

        $stats = [
            'total' => $users->count(),
            'aktif' => $users->where('is_active', true)->count(),
            'nonaktif' => $users->where('is_active', false)->count(),
            'tte_ready' => $users->whereNotNull('pin_tte')->count(),
        ];

        return view('manajemen-user', [
            'users' => $users,
            'stats' => $stats,
        ]);
    }

    /**
     * Menyimpan akun pegawai baru ke tabel users (Otoritas Admin Subbag Umpeg).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'nip' => ['required', 'string', 'max:18', 'unique:users,nip'],
                'nama_lengkap' => ['required', 'string', 'max:255'],
                'jabatan' => ['required', 'string', 'max:255'],
                'pangkat_golongan' => ['nullable', 'string', 'max:100'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'no_hp' => ['nullable', 'string', 'max:25'],
                'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_KASUBBAG, User::ROLE_SEKDIN, User::ROLE_KADIN])],
                'password' => ['required', 'string', 'min:6'],
            ],
            [
                'nip.required' => 'NIP Pegawai (18 digit) wajib diisi.',
                'nip.unique' => 'NIP Pegawai tersebut sudah terdaftar di dalam sistem.',
                'nama_lengkap.required' => 'Nama lengkap pegawai beserta gelar wajib diisi.',
                'jabatan.required' => 'Jabatan struktural/fungsional wajib diisi.',
                'email.required' => 'Alamat email resmi wajib diisi.',
                'email.email' => 'Format alamat email tidak valid.',
                'email.unique' => 'Alamat email tersebut sudah digunakan oleh akun pegawai lain.',
                'role.required' => 'Penetapan hak akses (role sistem) wajib dipilih.',
                'password.required' => 'Password sementara wajib diisi (minimal 6 karakter).',
                'password.min' => 'Password sementara minimal terdiri dari 6 karakter.',
            ]
        );

        $user = User::create([
            'nip' => trim($validated['nip']),
            'nama_lengkap' => trim($validated['nama_lengkap']),
            'jabatan' => trim($validated['jabatan']),
            'pangkat_golongan' => $validated['pangkat_golongan'] ? trim($validated['pangkat_golongan']) : null,
            'email' => strtolower(trim($validated['email'])),
            'no_hp' => $validated['no_hp'] ? trim($validated['no_hp']) : null,
            'role' => $validated['role'],
            'password' => $validated['password'],
            'pin_tte' => $validated['role'] === User::ROLE_KADIN ? '123456' : null,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('admin.users')
            ->with('status', 'Registrasi Akun Baru Berhasil: ' . $user->nama_lengkap . ' (NIP: ' . $user->nip . ') telah diaktifkan pada Single Gate RBAC.');
    }

    /**
     * Memperbarui data profil, jabatan, dan hak akses (role) pegawai.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate(
            [
                'nip' => ['required', 'string', 'max:18', Rule::unique('users', 'nip')->ignore($user->id)],
                'nama_lengkap' => ['required', 'string', 'max:255'],
                'jabatan' => ['required', 'string', 'max:255'],
                'pangkat_golongan' => ['nullable', 'string', 'max:100'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
                'no_hp' => ['nullable', 'string', 'max:25'],
                'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_KASUBBAG, User::ROLE_SEKDIN, User::ROLE_KADIN])],
            ],
            [
                'nip.unique' => 'NIP sudah terdaftar pada akun pegawai lain.',
                'email.unique' => 'Email sudah terdaftar pada akun pegawai lain.',
            ]
        );

        if ($user->id === Auth::id() && $validated['role'] !== User::ROLE_ADMIN) {
            return back()->with('error', 'Tidak dapat mengubah role akun Anda sendiri yang sedang login sebagai Administrator.');
        }

        $updateData = [
            'nip' => trim($validated['nip']),
            'nama_lengkap' => trim($validated['nama_lengkap']),
            'jabatan' => trim($validated['jabatan']),
            'pangkat_golongan' => $validated['pangkat_golongan'] ? trim($validated['pangkat_golongan']) : null,
            'email' => strtolower(trim($validated['email'])),
            'no_hp' => $validated['no_hp'] ? trim($validated['no_hp']) : null,
            'role' => $validated['role'],
        ];

        if ($validated['role'] === User::ROLE_KADIN && empty($user->pin_tte)) {
            $updateData['pin_tte'] = '123456';
        }

        $user->update($updateData);

        return redirect()
            ->route('admin.users')
            ->with('status', 'Data akun dan hak akses RBAC untuk ' . $user->nama_lengkap . ' berhasil diperbarui.');
    }

    /**
     * Mereset kata sandi (password) akun pegawai ke password sementara baru.
     */
    public function resetPassword(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'new_password' => ['required', 'string', 'min:6'],
        ], [
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
        ]);

        $user->update([
            'password' => $validated['new_password'],
        ]);

        return redirect()
            ->route('admin.users')
            ->with('status', 'Kata sandi akun ' . $user->nama_lengkap . ' (NIP: ' . $user->nip . ') berhasil di-reset.');
    }

    /**
     * Mengaktifkan atau menonaktifkan status akun pegawai (is_active).
     */
    public function toggleActive(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun Administrator yang sedang Anda gunakan.');
        }

        $user->update([
            'is_active' => ! $user->is_active,
        ]);

        $labelStatus = $user->is_active ? 'diaktifkan kembali' : 'dinonaktifkan';

        return redirect()
            ->route('admin.users')
            ->with('status', 'Status akun ' . $user->nama_lengkap . ' berhasil ' . $labelStatus . '.');
    }
}
