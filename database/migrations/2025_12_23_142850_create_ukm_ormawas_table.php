<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ukm_ormawas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('nama')->unique();
            $table->string('slug')->unique();
            $table->enum('tipe', ['UKM', 'Ormawa']);
            $table->enum('kategori', ['Kesenian & Budaya', 'Olahraga', 'Penalaran', 'Kerohanian', 'Sosial']);
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->json('misi')->nullable();
            $table->string('kontak_email')->nullable();
            $table->string('kontak_instagram')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('banner_url')->nullable();
            $table->char('id_provinsi', 2)->nullable(); // ID Provinsi
            $table->string('nama_provinsi')->nullable(); // Nama Provinsi
            $table->char('id_kabkota', 4)->nullable(); // ID Kab/Kota
            $table->string('nama_kabkota')->nullable(); // Nama Kab/Kota
            $table->char('id_kecamatan', 7)->nullable(); // ID Kecamatan
            $table->string('nama_kecamatan')->nullable(); // Nama Kecamatan
            $table->char('id_keldesa', 10)->nullable(); // ID Kelurahan/Desa
            $table->string('nama_keldesa')->nullable(); // Nama Kelurahan/Desa
            $table->text('alamat_jalan')->nullable(); // Alamat Jalan, RT/RW
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukm_ormawas');
    }
};
