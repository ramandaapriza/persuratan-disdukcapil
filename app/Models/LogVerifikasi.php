<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'naskah_type',
    'naskah_id',
    'tahap_verifikasi',
    'status_aksi',
    'verifikator_id',
    'catatan',
    'checklist_pemeriksaan',
    'waktu_verifikasi',
])]
class LogVerifikasi extends Model
{
    protected $table = 'log_verifikasi';

    protected function casts(): array
    {
        return [
            'checklist_pemeriksaan' => 'array',
            'waktu_verifikasi' => 'datetime',
        ];
    }

    public function naskah(): MorphTo
    {
        return $this->morphTo();
    }

    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verifikator_id');
    }
}
