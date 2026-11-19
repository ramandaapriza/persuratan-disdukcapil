<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_verifikasi', function (Blueprint $table) {
            $table->id();
            $table->morphs('naskah');
            $table->enum('tahap_verifikasi', ['staf_admin', 'kasubbag_umpeg', 'sekretaris_dinas', 'kepala_dinas']);
            $table->enum('status_aksi', ['diajukan', 'valid_kasubbag', 'valid_sekdin', 'ttd_kadin', 'revisi']);
            $table->foreignId('verifikator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('catatan')->nullable();
            $table->json('checklist_pemeriksaan')->nullable();
            $table->timestamp('waktu_verifikasi')->useCurrent();
            $table->timestamps();

            $table->index(['naskah_type', 'naskah_id', 'tahap_verifikasi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_verifikasi');
    }
};
