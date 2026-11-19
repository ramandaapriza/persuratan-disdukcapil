<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'surat_masuk_id',
    'kode_klasifikasi_id',
    'diserahkan_kepada_unit',
    'nama_pegawai_penerima',
    'tanggal_menerima',
    'sifat_disposisi',
    'instruksi_cepat',
    'catatan_kadin',
    'status_disposisi',
    'didisposisi_oleh',
])]
class DisposisiSuratMasuk extends Model
{
    protected $table = 'disposisi_surat_masuk';

    protected function casts(): array
    {
        return [
            'tanggal_menerima' => 'date',
            'instruksi_cepat' => 'array',
        ];
    }

    public function suratMasuk(): BelongsTo
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    public function kodeKlasifikasi(): BelongsTo
    {
        return $this->belongsTo(KodeKlasifikasi::class, 'kode_klasifikasi_id');
    }

    public function kadin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'didisposisi_oleh');
    }
}
