<?php

namespace App\Models;

use App\Models\Concerns\HasVerifikasiBerjenjang;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'nomor_urut',
    'kode_klasifikasi_id',
    'nomor_sppd',
    'tanggal_surat',
    'pegawai_id',
    'nama_pegawai',
    'nip_pegawai',
    'jabatan_pegawai',
    'tanggal_berangkat',
    'tanggal_kembali',
    'daerah_tujuan',
    'urusan_perjalanan',
    'status',
    'catatan_revisi',
    'tte_token_uuid',
    'signed_by',
    'signed_at',
    'created_by',
])]
class Sppd extends Model
{
    use HasVerifikasiBerjenjang;

    protected $table = 'sppd';

    protected function casts(): array
    {
        return [
            'tanggal_surat' => 'date',
            'tanggal_berangkat' => 'date',
            'tanggal_kembali' => 'date',
            'signed_at' => 'datetime',
        ];
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pegawai_id');
    }
}
