<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['kode_bidang', 'nama_bidang', 'keterangan'])]
class KodeKlasifikasi extends Model
{
    protected $table = 'kode_klasifikasi';

    public function suratMasuk(): HasMany
    {
        return $this->hasMany(SuratMasuk::class, 'kode_klasifikasi_id');
    }

    public function disposisiSuratMasuk(): HasMany
    {
        return $this->hasMany(DisposisiSuratMasuk::class, 'kode_klasifikasi_id');
    }

    public function suratKeluar(): HasMany
    {
        return $this->hasMany(SuratKeluar::class, 'kode_klasifikasi_id');
    }

    public function sppd(): HasMany
    {
        return $this->hasMany(Sppd::class, 'kode_klasifikasi_id');
    }

    public function beritaAcara(): HasMany
    {
        return $this->hasMany(BeritaAcara::class, 'kode_klasifikasi_id');
    }
}
