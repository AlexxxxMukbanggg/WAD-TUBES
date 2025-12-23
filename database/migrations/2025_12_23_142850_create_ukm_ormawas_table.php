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
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->enum('type', ['UKM', 'Ormawa']);
            $table->enum('category', ['Kesenian & Budaya', 'Olahraga', 'Penalaran', 'Kerohanian', 'Sosial']);
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->json('misi')->nullable();
            $table->string('kontak_email')->nullable();
            $table->string('kontak_instagram')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('banner_url')->nullable();
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
