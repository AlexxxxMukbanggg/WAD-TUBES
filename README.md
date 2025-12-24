# Student Center (TUBES PAW)

Proyek ini adalah tugas besar Pengembangan Aplikasi Website (PAW). Aplikasi ini berfungsi untuk mengurus dan memaparkan informasi mengenai Unit Kegiatan Mahasiswa (UKM) dan Organisasi Mahasiswa (Ormawa), studi kasus di Telkom University.

## Teknologi yang Digunakan

* **Rangka Kerja (Framework):** [Laravel](https://laravel.com/) (PHP)
* **Database:** MySQL
* **Frontend:** Blade Templates, Bootstrap (CSS/JS), Vite
* **Server:** Apache/Nginx (melalui XAMPP/Laragon atau `php artisan serve`)

## Keperluan Sistem (Prerequisites)

Sebelum menjalankan, pastikan komputer anda mempunyai:

* PHP >= 8.2
* Composer
* MySQL

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk proyek ini di komputer anda:

1.  **Clone Repositori**
    ```bash
    git clone https://github.com/AlexxxxMukbanggg/WAD-TUBES.git
    cd wad-tubes
    ```

2.  **Pasang Dependensi PHP (Composer)**
    ```bash
    composer install
    ```

3.  **Environment (.env)**
    Salin file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan konfigurasikan database anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Buat kunci aplikasi**
    ```bash
    php artisan key:generate
    ```

5.  **Migrasi dan Seed Database**
    Jalankan migrasi untuk membuat data dummy:
    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Aplikasi kini bisa diakses di `http://localhost:8000`.