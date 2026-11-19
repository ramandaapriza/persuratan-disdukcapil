<?php

namespace App\Models\Concerns;

use App\Models\KodeKlasifikasi;
use App\Models\LogVerifikasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasVerifikasiBerjenjang
{
    public function kodeKlasifikasi(): BelongsTo
    {
        return $this->belongsTo(KodeKlasifikasi::class, 'kode_klasifikasi_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function penandatangan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signed_by');
    }

    public function logVerifikasi(): MorphMany
    {
        return $this->morphMany(LogVerifikasi::class, 'naskah')->orderBy('waktu_verifikasi');
    }
}
