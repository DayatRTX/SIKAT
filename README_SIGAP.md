# SiGAP Polsri - Sistem Gangguan & Perbaikan Polsri

Sistem manajemen laporan kerusakan dan perbaikan fasilitas kampus Politeknik Negeri Sriwijaya.

## 🎨 Desain

Menggunakan **Tailwind CSS** dengan palet warna soft modern:

-   **Primary:** #B1B2FF
-   **Secondary:** #AAC4FF
-   **Tertiary:** #D2DAFF
-   **Background:** #EEF1FF

Font: **Poppins** & **Inter**

## 🚀 Cara Setup & Menjalankan

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Setup Environment

```bash
# Copy file .env
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Konfigurasi Database

Edit file `.env` dan sesuaikan:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sigap_polsri
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migration & Seeder

```bash
php artisan migrate:fresh --seed
```

### 5. Buat Storage Link

```bash
php artisan storage:link
```

### 6. Compile Assets (Tailwind CSS)

```bash
npm run dev
```

Atau untuk production:

```bash
npm run build
```

### 7. Jalankan Server

Di terminal baru, jalankan:

```bash
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

## 👥 Akun Demo

### Admin

-   **Email:** admin@polsri.ac.id
-   **Password:** admin123

### Teknisi

-   **Email:** teknisi@polsri.ac.id
-   **Password:** teknisi123

### Mahasiswa

-   **Email:** mahasiswa@polsri.ac.id
-   **Password:** mahasiswa123

## 📋 Fitur Berdasarkan Role

### 🎓 Mahasiswa

-   ✅ Register & Login
-   ✅ Dashboard dengan statistik & widget cuaca
-   ✅ Buat laporan kerusakan baru (upload foto)
-   ✅ Lihat riwayat laporan sendiri
-   ✅ Lihat status perbaikan real-time

### 👨‍💼 Admin

-   ✅ Login
-   ✅ Dashboard dengan overview semua laporan
-   ✅ Lihat semua laporan masuk
-   ✅ Validasi laporan (Terima/Tolak)
-   ✅ Tugaskan teknisi ke laporan
-   ✅ Filter laporan berdasarkan status

### 🔧 Teknisi

-   ✅ Login
-   ✅ Dashboard dengan daftar tugas
-   ✅ Lihat detail tugas perbaikan
-   ✅ Update status menjadi "Selesai"
-   ✅ Upload foto hasil perbaikan

## 🔌 Integrasi API

Widget cuaca di dashboard menggunakan:

-   **API:** OpenWeatherMap (atau API publik lainnya)
-   **Data:** Suhu, kelembaban, kondisi cuaca untuk kota Palembang
-   **Note:** Saat ini menggunakan data fallback. Untuk mengaktifkan API live, uncomment kode di `DashboardController.php` dan masukkan API key Anda.

## 🗂️ Struktur Database

### Tabel: users

-   id, name, email, password, role (admin/mahasiswa/teknisi), timestamps

### Tabel: reports

-   id, user_id, technician_id, title, description, location, category
-   image_before, image_after, status (pending/process/done/rejected)
-   reject_reason, timestamps

## 🎯 Teknologi yang Digunakan

-   **Framework:** Laravel 12
-   **CSS:** Tailwind CSS v4
-   **Icons:** Font Awesome 6
-   **Database:** MySQL
-   **Frontend:** Blade Templates
-   **Build Tool:** Vite

## 📝 Catatan Penting

1. **Middleware:** Sistem menggunakan custom middleware `CheckRole` untuk proteksi route
2. **Upload Files:** Foto disimpan di `storage/app/public/reports`
3. **Validation:** Semua form menggunakan validasi dengan pesan Bahasa Indonesia
4. **Responsive:** Semua halaman fully responsive untuk mobile & desktop

## 🎓 Tugas Akhir Semester

Project ini dibuat untuk memenuhi tugas akhir semester dengan fokus pada:

-   ✅ Clean & Professional UI/UX
-   ✅ Role-based Access Control
-   ✅ File Upload Management
-   ✅ API Integration
-   ✅ Database Relationships
-   ✅ Modern Design Pattern

---

**Developed by:** [Nama Anda]  
**Institusi:** Politeknik Negeri Sriwijaya  
**Tahun:** 2024
