<?php

namespace App\Models;

use App\Models\Concerns\HasVerifikasiBerjenjang;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nomor_urut',
    'kode_klasifikasi_id',
    'nomor_berita_acara',
    'tanggal_berita_acara',
    'pihak_kedua',
    'perihal',
    'file_dokumen',
    'status',
    'catatan_revisi',
    'tte_token_uuid',
    'signed_by',
    'signed_at',
    'created_by',
])]
class BeritaAcara extends Model
{
    use HasVerifikasiBerjenjang;

    protected $table = 'berita_acara';

    protected function casts(): array
    {
        return [
            'tanggal_berita_acara' => 'date',
            'signed_at' => 'datetime',
        ];
    }
}
