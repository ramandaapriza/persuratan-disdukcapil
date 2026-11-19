<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nomor_urut');
            $table->foreignId('kode_klasifikasi_id')->constrained('kode_klasifikasi');
            $table->unsignedSmallInteger('tahun')->default(2026);
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_dikeluarkan');
            $table->string('alamat_tujuan');
            $table->text('perihal');
            $table->string('sifat', 20)->default('Penting');
            $table->string('lampiran')->nullable();
            $table->string('file_konsep')->nullable();
            $table->enum('status', ['draf', 'valid_kasubbag', 'valid_sekdin', 'ttd_kadin', 'revisi'])->default('draf')->index();
            $table->text('catatan_revisi')->nullable();
            $table->uuid('tte_token_uuid')->nullable()->unique();
            $table->foreignId('signed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('signed_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('sppd', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nomor_urut');
            $table->foreignId('kode_klasifikasi_id')->constrained('kode_klasifikasi');
            $table->string('nomor_sppd')->unique();
            $table->date('tanggal_surat');
            $table->foreignId('pegawai_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_pegawai');
            $table->string('nip_pegawai', 18)->nullable();
            $table->string('jabatan_pegawai');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->string('daerah_tujuan');
            $table->text('urusan_perjalanan');
            $table->enum('status', ['draf', 'valid_kasubbag', 'valid_sekdin', 'ttd_kadin', 'revisi'])->default('draf')->index();
            $table->text('catatan_revisi')->nullable();
            $table->uuid('tte_token_uuid')->nullable()->unique();
            $table->foreignId('signed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('signed_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('berita_acara', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nomor_urut');
            $table->foreignId('kode_klasifikasi_id')->constrained('kode_klasifikasi');
            $table->string('nomor_berita_acara')->unique();
            $table->date('tanggal_berita_acara');
            $table->string('pihak_kedua');
            $table->text('perihal');
            $table->string('file_dokumen')->nullable();
            $table->enum('status', ['draf', 'valid_kasubbag', 'valid_sekdin', 'ttd_kadin', 'revisi'])->default('draf')->index();
            $table->text('catatan_revisi')->nullable();
            $table->uuid('tte_token_uuid')->nullable()->unique();
            $table->foreignId('signed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('signed_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_acara');
        Schema::dropIfExists('sppd');
        Schema::dropIfExists('surat_keluar');
    }
};
