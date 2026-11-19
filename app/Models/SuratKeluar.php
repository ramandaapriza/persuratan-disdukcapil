<?php

namespace App\Models;

use App\Models\Concerns\HasVerifikasiBerjenjang;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nomor_urut',
    'kode_klasifikasi_id',
    'tahun',
    'nomor_surat',
    'tanggal_dikeluarkan',
    'alamat_tujuan',
    'perihal',
    'sifat',
    'lampiran',
    'file_konsep',
    'status',
    'catatan_revisi',
    'tte_token_uuid',
    'signed_by',
    'signed_at',
    'created_by',
])]
class SuratKeluar extends Model
{
    use HasVerifikasiBerjenjang;

    protected $table = 'surat_keluar';

    protected function casts(): array
    {
        return [
            'tanggal_dikeluarkan' => 'date',
            'signed_at' => 'datetime',
        ];
    }

    public static function formatNomorOtomatis(string $kodeBidang, int $nomorUrut, int $tahun = 2026): string
    {
        return "{$kodeBidang}/{$nomorUrut}/disdukcapil/{$tahun}";
    }
}
