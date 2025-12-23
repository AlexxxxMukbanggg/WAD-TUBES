<?php

namespace Database\Seeders;

use App\Models\UkmOrmawa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UkmOrmawaSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('ukm_logos');
        Storage::disk('public')->makeDirectory('ukm_banners');

        $sourceLogoBadminton = public_path('images/Badminton.png');
        $sourceBannerBadminton = public_path('images/badminton banner.jpeg'); 


        // Fungsi helper kecil untuk copy file ke storage dan return path-nya
        $storeImage = function ($sourcePath, $destinationFolder) {
            if (File::exists($sourcePath)) {
                $filename = time() . '_' . basename($sourcePath);
                // Copy file dari sumber ke storage/app/public/...
                Storage::disk('public')->put($destinationFolder . '/' . $filename, File::get($sourcePath));
                return $destinationFolder . '/' . $filename;
            }
            return null; // Return null jika file sumber tidak ada
        };

        // --- BUAT UKM Badminton ---
        $userBadminton = User::create([
            'name' => 'Admin UKM Badminton',
            'email' => 'badminton@telkomuniversity.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'pengelola',
            'email_verified_at' => now(),
        ]);

        $badminton = UkmOrmawa::create([
            'user_id' => $userBadminton->id,
            'nama' => 'Badminton',
            'slug' => 'badminton',
            'tipe' => 'UKM',
            'kategori' => 'Olahraga',
            'deskripsi' => 'Unit Kegiatan Mahasiswa bidang olahraga bulutangkis.',
            'visi' => 'Mencetak atlet berprestasi.',
            'misi' => ['Latihan rutin', 'Mengadakan turnamen internal', 'Mengikuti lomba nasional'],
            'kontak_email' => 'badminton@telkomuniversity.ac.id',
            'kontak_instagram' => '@ukmbadminton_telu',
            'alamat_jalan' => 'Gedung SC Lt. 1',

             // SIMPAN GAMBAR DISINI (Menggunakan gambar yang sama sebagai contoh)
            'logo_url' => $storeImage($sourceLogoBadminton, 'ukm_logos'),
            'banner_url' => $storeImage($sourceBannerBadminton, 'ukm_banners'),
        ]);
        
        $userBadminton->update(['manages_ukm_ormawa_id' => $badminton->id]);

        // --- FACTORY (10 Random) ---
        $randomUkms = UkmOrmawa::factory()->count(10)->create();

        foreach ($randomUkms as $ukm) {
            $ukm->user->update(['manages_ukm_ormawa_id' => $ukm->id]);
        }
    }
}