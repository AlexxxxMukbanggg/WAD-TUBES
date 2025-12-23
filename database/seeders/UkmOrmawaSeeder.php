<?php

namespace Database\Seeders;

use App\Models\UkmOrmawa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UkmOrmawaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat BEM (Ormawa) - Manual
        $userBem = User::create([
            'name' => 'Admin BEM KEMA',
            'email' => 'bemkema@telkomuniversity.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'pengelola',
            'email_verified_at' => now(),
        ]);

        $bem = UkmOrmawa::create([
            'user_id' => $userBem->id,
            'nama' => 'BEM KEMA Tel-U',
            'slug' => 'bem-kema-tel-u',
            'tipe' => 'Ormawa',
            'kategori' => 'Sosial',
            'deskripsi' => 'Badan Eksekutif Mahasiswa Keluarga Mahasiswa Telkom University.',
            'visi' => 'Menjadikan BEM KEMA sebagai poros pergerakan mahasiswa.',
            'misi' => ['Membangun sinergi', 'Meningkatkan pelayanan', 'Mengabdi pada masyarakat'],
            'kontak_email' => 'bem@telkomuniversity.ac.id',
            'kontak_instagram' => '@bemkematelu',
            'alamat_jalan' => 'Gedung SC Lt. 2, Telkom University',
            'nama_provinsi' => 'JAWA BARAT',
            'nama_kabkota' => 'KABUPATEN BANDUNG',
        ]);

        // Update relation di user (opsional jika logic aplikasi butuh update balik)
        $userBem->update(['manages_ukm_ormawa_id' => $bem->id]);


        $userBadminton = User::create([
            'name' => 'Admin UKM Badminton',
            'email' => 'badminton@telkomuniversity.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'pengelola',
            'email_verified_at' => now(),
        ]);

        $badminton = UkmOrmawa::create([
            'user_id' => $userBadminton->id,
            'nama' => 'UKM Badminton',
            'slug' => 'ukm-badminton',
            'tipe' => 'UKM',
            'kategori' => 'Olahraga',
            'deskripsi' => 'Unit Kegiatan Mahasiswa bidang olahraga bulutangkis.',
            'visi' => 'Mencetak atlet berprestasi.',
            'misi' => ['Latihan rutin', 'Mengadakan turnamen internal', 'Mengikuti lomba nasional'],
            'kontak_email' => 'badminton@telkomuniversity.ac.id',
            'kontak_instagram' => '@ukmbadminton_telu',
            'alamat_jalan' => 'Gedung SC Lt. 1',
        ]);
        
        $userBadminton->update(['manages_ukm_ormawa_id' => $badminton->id]);

        // Generate 10 UKM/Ormawa Random Tambahan menggunakan Factory
        // Factory sudah otomatis membuat User Pengelola (lihat UkmOrmawaFactory)
        $randomUkms = UkmOrmawa::factory()->count(10)->create();

        // Loop untuk update kolom manages_ukm_ormawa_id di tabel users agar sinkron
        foreach ($randomUkms as $ukm) {
            $ukm->user->update(['manages_ukm_ormawa_id' => $ukm->id]);
        }
    }
}