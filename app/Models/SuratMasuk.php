<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'nomor_urut_agenda',
    'tanggal_diterima',
    'pengirim',
    'tanggal_surat',
    'nomor_surat',
    'perihal',
    'sifat_surat',
    'kode_klasifikasi_id',
    'file_lampiran',
    'tanggal_naik_kadin',
    'ajudan_id',
    'nama_ajudan_penerima',
    'status_kenaikan',
    'status',
    'created_by',
])]
class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';

    protected function casts(): array
    {
        return [
            'tanggal_diterima' => 'date',
            'tanggal_surat' => 'date',
            'tanggal_naik_kadin' => 'datetime',
        ];
    }

    public function kodeKlasifikasi(): BelongsTo
    {
        return $this->belongsTo(KodeKlasifikasi::class, 'kode_klasifikasi_id');
    }

    public function ajudan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ajudan_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function disposisi(): HasMany
    {
        return $this->hasMany(DisposisiSuratMasuk::class, 'surat_masuk_id');
    }
}
