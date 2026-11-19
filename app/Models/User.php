<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'nip',
    'nama_lengkap',
    'jabatan',
    'pangkat_golongan',
    'no_hp',
    'email',
    'role',
    'password',
    'pin_tte',
    'is_active',
])]
#[Hidden([
    'password',
    'pin_tte',
    'remember_token',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_KASUBBAG = 'kasubbag';
    public const ROLE_SEKDIN = 'sekdin';
    public const ROLE_KADIN = 'kadin';

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'pin_tte' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function suratMasukDibuat(): HasMany
    {
        return $this->hasMany(SuratMasuk::class, 'created_by');
    }

    public function suratMasukDiterimaAjudan(): HasMany
    {
        return $this->hasMany(SuratMasuk::class, 'ajudan_id');
    }

    public function disposisiDiberikan(): HasMany
    {
        return $this->hasMany(DisposisiSuratMasuk::class, 'didisposisi_oleh');
    }

    public function suratKeluarDibuat(): HasMany
    {
        return $this->hasMany(SuratKeluar::class, 'created_by');
    }

    public function suratKeluarDitandatangani(): HasMany
    {
        return $this->hasMany(SuratKeluar::class, 'signed_by');
    }

    public function sppdDiperintahkan(): HasMany
    {
        return $this->hasMany(Sppd::class, 'pegawai_id');
    }

    public function beritaAcaraDibuat(): HasMany
    {
        return $this->hasMany(BeritaAcara::class, 'created_by');
    }

    public function logVerifikasi(): HasMany
    {
        return $this->hasMany(LogVerifikasi::class, 'verifikator_id');
    }
}
