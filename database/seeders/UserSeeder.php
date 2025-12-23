<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Pengelola 1',
            'email' => 'pengelola1@telkomuniversity.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'pengelola',
            'nim' => '102022300001',
            'email_verified_at' => now(),
            // 'manages_ukm_ormawa_id' => 1, // Bisa diisi nanti jika UKM sudah ada
        ]);

        User::create([
            'name' => 'Admin Pengelola 1',
            'email' => 'pengelola2@telkomuniversity.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'pengelola',
            'nim' => '102022300002',
            'email_verified_at' => now(),
            // 'manages_ukm_ormawa_id' => 1, // Bisa diisi nanti jika UKM sudah ada
        ]);

        // 2. Buat Akun Mahasiswa
        User::create([
            'name' => 'Mahasiswa Telkom',
            'email' => 'mahasiswa@student.telkomuniversity.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
            'nim' => '102022300003',
            'email_verified_at' => now(),
        ]);
    }
}