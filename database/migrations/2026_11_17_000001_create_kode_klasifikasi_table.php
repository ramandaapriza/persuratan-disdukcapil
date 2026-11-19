<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kode_klasifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bidang', 10)->unique();
            $table->string('nama_bidang');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kode_klasifikasi');
    }
};
