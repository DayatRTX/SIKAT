# 🎓 PANDUAN LENGKAP - SiGAP Polsri

## ✅ STATUS INSTALASI

**Database:** ✅ Berhasil dibuat (sigap_polsri)  
**Migration:** ✅ Berhasil dijalankan  
**Seeder:** ✅ Akun demo sudah dibuat  
**Assets:** ✅ Tailwind CSS berhasil di-compile  
**Server:** ✅ Berjalan di http://127.0.0.1:8000

---

## 🚀 CARA MENGAKSES APLIKASI

1. **Pastikan Server Laravel Berjalan**

    ```bash
    php artisan serve
    ```

2. **Buka Browser**
   Akses: **http://127.0.0.1:8000** atau **http://localhost:8000**

3. **Login dengan Akun Demo**

    ### 🎓 Mahasiswa

    - Email: `mahasiswa@polsri.ac.id`
    - Password: `mahasiswa123`

    ### 👨‍💼 Admin

    - Email: `admin@polsri.ac.id`
    - Password: `admin123`

    ### 🔧 Teknisi

    - Email: `teknisi@polsri.ac.id`
    - Password: `teknisi123`

---

## 📝 WORKFLOW TESTING APLIKASI

### Skenario 1: Mahasiswa Membuat Laporan

1. Login sebagai **Mahasiswa**
2. Klik menu **"Buat Laporan"** di sidebar
3. Isi form:
    - Judul: "AC Ruang Kelas Rusak"
    - Lokasi: "Gedung A - Ruang 201"
    - Kategori: Pilih "AC / Pendingin Ruangan"
    - Deskripsi: "AC tidak dingin dan mengeluarkan suara bising"
    - Upload foto kerusakan
4. Klik **"Kirim Laporan"**
5. Cek di menu **"Riwayat Laporan"** - Status: **Pending**

### Skenario 2: Admin Memvalidasi & Menugaskan

1. Logout, lalu login sebagai **Admin**
2. Lihat laporan baru di **"Kelola Laporan"**
3. Klik **"Detail"** pada laporan
4. Klik **"Terima Laporan"**
5. Pilih **Teknisi** dari dropdown
6. Klik **"Tugaskan"** - Status berubah menjadi **Process**

### Skenario 3: Teknisi Menyelesaikan Perbaikan

1. Logout, lalu login sebagai **Teknisi**
2. Lihat tugas di **"Tugas Perbaikan"**
3. Klik **"Kerjakan Tugas"**
4. Upload **Foto Hasil Perbaikan**
5. Klik **"Tandai Selesai"** - Status berubah menjadi **Done**

### Skenario 4: Mahasiswa Melihat Hasil

1. Login kembali sebagai **Mahasiswa**
2. Buka **"Riwayat Laporan"**
3. Lihat laporan dengan status **Selesai** ✅
4. Klik detail untuk melihat foto sebelum & sesudah perbaikan

---

## 🎨 FITUR UNGGULAN

### ✨ UI/UX Modern

-   ✅ Palet warna soft pastel yang eye-catching
-   ✅ Font Poppins untuk kesan profesional
-   ✅ Animasi smooth pada button & card
-   ✅ Fully responsive (Mobile & Desktop)
-   ✅ Icon Font Awesome 6

### 📊 Dashboard Interaktif

-   ✅ Widget statistik real-time
-   ✅ **Widget Cuaca API** (Palembang)
-   ✅ Tabel laporan terbaru
-   ✅ Color-coded status badges

### 🔐 Role-Based Access Control

-   ✅ Middleware custom `CheckRole`
-   ✅ Route protection per role
-   ✅ UI dinamis berdasarkan role user

### 📸 Upload & Manajemen File

-   ✅ Upload foto bukti kerusakan
-   ✅ Upload foto hasil perbaikan
-   ✅ Preview image sebelum upload
-   ✅ Image modal untuk full-size view

### 🔔 Notifikasi & Validasi

-   ✅ Flash messages dengan animasi
-   ✅ Form validation dengan pesan Bahasa Indonesia
-   ✅ Error handling yang user-friendly

---

## 📂 STRUKTUR PROJECT

```
SiGAP-Polsri/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php         # Login, Register, Logout
│   │   │   ├── DashboardController.php    # Dashboard + API Cuaca
│   │   │   └── ReportController.php       # CRUD Laporan
│   │   └── Middleware/
│   │       └── CheckRole.php              # Custom Middleware Role
│   └── Models/
│       ├── User.php                       # Model User (+ role)
│       └── Report.php                     # Model Laporan
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   └── 2024_12_11_000001_create_reports_table.php
│   └── seeders/
│       └── DatabaseSeeder.php             # Seeder 3 akun demo
│
├── resources/
│   ├── css/
│   │   └── app.css                        # Tailwind CSS + Custom Styles
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php              # Main Layout (Navbar + Sidebar)
│       ├── auth/
│       │   ├── login.blade.php            # Halaman Login
│       │   └── register.blade.php         # Halaman Register
│       ├── dashboard.blade.php            # Dashboard dengan Widget API
│       ├── mahasiswa/
│       │   └── reports/
│       │       ├── create.blade.php       # Form Buat Laporan
│       │       ├── index.blade.php        # Riwayat Laporan
│       │       └── show.blade.php         # Detail Laporan
│       ├── admin/
│       │   └── reports/
│       │       ├── index.blade.php        # Kelola Laporan
│       │       └── show.blade.php         # Detail + Validasi + Assign
│       └── teknisi/
│           └── tasks/
│               ├── index.blade.php        # Daftar Tugas
│               └── show.blade.php         # Detail + Complete Task
│
└── routes/
    └── web.php                            # Route dengan Middleware Group
```

---

## 🛠️ TROUBLESHOOTING

### Server tidak bisa diakses?

```bash
# Pastikan server berjalan
php artisan serve

# Cek apakah port 8000 sudah digunakan
# Gunakan port lain jika perlu:
php artisan serve --port=8080
```

### CSS tidak muncul?

```bash
# Build ulang assets
npm run build

# Atau jalankan dalam mode dev (auto-reload)
npm run dev
```

### Error upload file?

```bash
# Pastikan storage link sudah dibuat
php artisan storage:link

# Cek permission folder storage
# Pastikan folder storage/app/public dapat ditulis
```

### Database error?

```bash
# Reset database
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 📋 CHECKLIST PENILAIAN TUGAS AKHIR

-   ✅ **Routing:** Route Group dengan Middleware ✔️
-   ✅ **Controller:** Terpisah (Auth, Dashboard, Report) ✔️
-   ✅ **Model & Migration:** User & Report dengan relasi ✔️
-   ✅ **View (Blade):** Layout, Auth, Dashboard, CRUD ✔️
-   ✅ **API Integration:** Widget Cuaca di Dashboard ✔️
-   ✅ **File Upload:** Foto sebelum & sesudah perbaikan ✔️
-   ✅ **Validation:** Form validation Bahasa Indonesia ✔️
-   ✅ **Authentication:** Login, Register, Logout ✔️
-   ✅ **Authorization:** Role-based (Admin, Mahasiswa, Teknisi) ✔️
-   ✅ **UI/UX:** Tailwind CSS dengan palet warna custom ✔️
-   ✅ **Responsive Design:** Mobile & Desktop friendly ✔️
-   ✅ **Database Seeder:** 3 akun demo siap pakai ✔️

---

## 🎯 TIPS PRESENTASI

1. **Demo Alur Lengkap:**

    - Tunjukkan workflow dari mahasiswa lapor → admin validasi → teknisi selesaikan

2. **Highlight Fitur Unik:**

    - Widget API Cuaca (bukti integrasi eksternal)
    - Upload foto before-after
    - Role-based dashboard yang berbeda

3. **Jelaskan Teknologi:**

    - Laravel 12 (framework terbaru)
    - Tailwind CSS v4 (styling modern)
    - Middleware custom untuk role
    - Eloquent Relationships

4. **Tunjukkan Kode Penting:**
    - Middleware CheckRole
    - DashboardController (API integration)
    - ReportController (upload file logic)

---

## 📞 SUPPORT

Jika ada pertanyaan atau kendala, cek:

-   **README_SIGAP.md** untuk panduan teknis
-   **database.sql** untuk struktur database
-   Komentar di kode (sudah diberi penjelasan Bahasa Indonesia)

---

**Good Luck! 🚀**  
_Politeknik Negeri Sriwijaya - 2024_
