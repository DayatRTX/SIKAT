-- Buat Database SiGAP Polsri
CREATE DATABASE IF NOT EXISTS sigap_polsri CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Gunakan database
USE sigap_polsri;

-- Database akan diisi otomatis saat menjalankan: php artisan migrate:fresh --seed
