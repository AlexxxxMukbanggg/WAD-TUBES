<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UkmOrmawa>
 */
class UkmOrmawaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nama = fake()->unique()->company();
        // Pilih tipe secara acak
        $tipe = fake()->randomElement(['UKM', 'Ormawa']);
        
        // Kategori sesuai enum di migrasi
        $kategori = fake()->randomElement(['Kesenian & Budaya', 'Olahraga', 'Penalaran', 'Kerohanian', 'Sosial']);

        return [
            // Buat user baru dengan role pengelola untuk setiap UKM
            'user_id' => User::factory()->state(['role' => 'pengelola']),
            'nama' => $nama,
            'slug' => Str::slug($nama),
            'tipe' => $tipe,
            'kategori' => $kategori,
            'deskripsi' => fake()->paragraph(),
            'visi' => fake()->sentence(),
            'misi' => [fake()->sentence(), fake()->sentence(), fake()->sentence()], // Disimpan sebagai JSON
            'kontak_email' => fake()->safeEmail(),
            'kontak_instagram' => '@' . Str::slug($nama),
            'logo_url' => 'https://placehold.co/400x400/png?text=Logo',
            'banner_url' => 'https://placehold.co/1200x400/png?text=Banner',
            
            // Data Wilayah Dummy
            'id_provinsi' => '32',
            'nama_provinsi' => 'JAWA BARAT',
            'id_kabkota' => '3204',
            'nama_kabkota' => 'KABUPATEN BANDUNG',
            'id_kecamatan' => '3204050',
            'nama_kecamatan' => 'BOJONGSOANG',
            'id_keldesa' => '3204050001',
            'nama_keldesa' => 'BOJONGSOANG',
            'alamat_jalan' => fake()->address(),
        ];
    }
}