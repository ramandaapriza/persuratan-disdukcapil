<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_urut_agenda', 15)->unique();
            $table->date('tanggal_diterima');
            $table->string('pengirim');
            $table->date('tanggal_surat');
            $table->string('nomor_surat');
            $table->text('perihal');
            $table->string('sifat_surat', 20)->default('Biasa');
            $table->foreignId('kode_klasifikasi_id')->nullable()->constrained('kode_klasifikasi')->nullOnDelete();
            $table->string('file_lampiran')->nullable();
            $table->dateTime('tanggal_naik_kadin')->nullable();
            $table->foreignId('ajudan_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_ajudan_penerima')->nullable();
            $table->string('status_kenaikan', 30)->default('belum_naik');
            $table->string('status', 30)->default('baru')->index();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('disposisi_surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_masuk_id')->constrained('surat_masuk')->cascadeOnDelete();
            $table->foreignId('kode_klasifikasi_id')->constrained('kode_klasifikasi');
            $table->string('diserahkan_kepada_unit');
            $table->string('nama_pegawai_penerima');
            $table->date('tanggal_menerima');
            $table->string('sifat_disposisi', 20)->default('Segera');
            $table->json('instruksi_cepat')->nullable();
            $table->text('catatan_kadin')->nullable();
            $table->string('status_disposisi', 30)->default('diproses')->index();
            $table->foreignId('didisposisi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disposisi_surat_masuk');
        Schema::dropIfExists('surat_masuk');
    }
};
