# Aplikasi Manajemen Klinik

Aplikasi ini adalah sistem manajemen klinik berbasis web yang dibangun menggunakan Laravel 12. Aplikasi ini mendukung berbagai fitur seperti pendaftaran pasien, transaksi dokter, pembayaran tagihan oleh kasir, laporan klinik dengan visualisasi grafik, filter laporan, dan export PDF. Aplikasi ini menggunakan autentikasi dengan Laravel Breeze dan manajemen role dengan Spatie Laravel Permission.

## Fitur Utama

### Role-based Access
- **Admin**: Mengelola pengguna, pegawai, tindakan, obat, dan melihat laporan.
- **Petugas**: Mendaftarkan pasien dan kunjungan.
- **Dokter**: Melakukan transaksi tindakan dan obat.
- **Kasir**: Memproses pembayaran tagihan pasien.

### Laporan Klinik
- Grafik kunjungan pasien per hari, tindakan terbanyak, dan obat yang paling sering diresepkan (menggunakan Chart.js).
- Filter laporan berdasarkan rentang tanggal.
- Export laporan ke PDF (menggunakan barryvdh/laravel-dompdf).

### Halaman Welcome
Desain responsif dengan Tailwind CSS, mencakup header, hero section, dan layanan.

## Prasyarat

Sebelum menjalankan aplikasi, pastikan Anda memiliki:
- PHP >= 8.2
- Composer (untuk manajemen dependensi PHP)
- Node.js dan npm (untuk Tailwind CSS dan Vite)
- PostgresSQL
- Git (opsional, untuk kloning repositori)

## Langkah Instalasi

### 1. Clone Repositori (Opsional)
```bash
git clone https://github.com/KingWahid/test-kompetensi-inovamedika-wahidan.git
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Install Dependensi Frontend
```bash
npm install
```

### 4. Konfigurasi Environment
```bash
cp .env.example .env
```
Edit file `.env` untuk mengatur koneksi database:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_kompetensi_invomedika_wahidan
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Jalankan Migrasi dan Seeder
```bash
php artisan migrate
php artisan db:seed
```

### 6. Build Frontend Assets
```bash
npm run build
```

### 7. Jalankan Aplikasi
```bash
php artisan serve
```

## Akun Default

| Role    | Email                 | Password |
|---------|-----------------------|----------|
| Admin   | admin@example.com     | password |
| Petugas | petugas@example.com   | password |
| Dokter  | dokter@example.com    | password |
| Kasir   | kasir@example.com     | password |

## Struktur Aplikasi

- **Routes**: `routes/web.php`
- **Controllers**:
  - `app/Http/Controllers/Admin/`
  - `app/Http/Controllers/Petugas/`
  - `app/Http/Controllers/Dokter/`
  - `app/Http/Controllers/Kasir/`
- **Views**:
  - `resources/views/wel.blade.php`
  - `resources/views/admin/`
  - `resources/views/petugas/`
  - `resources/views/dokter/`
  - `resources/views/kasir/`
- **Models**: `app/Models/` (User, Pasien, Kunjungan, TransaksiKunjungan, Pembayaran, dll.)
- **Assets**: `public/images/`

## Penggunaan Fitur

### Admin Dashboard
- Login sebagai admin.
- Akses `/admin/dashboard` dan `/admin/laporans`.

### Petugas Dashboard
- Login sebagai petugas.
- Akses `/petugas/dashboard`.

### Dokter Dashboard
- Login sebagai dokter.
- Akses `/dokter/dashboard`.

### Kasir Dashboard
- Login sebagai kasir.
- Akses `/kasir/dashboard`.

## Troubleshooting

- **Database Error**: Pastikan konfigurasi `.env` benar.
- **Frontend Tidak Berjalan**: Jalankan `npm run build`, cek error di browser console.
- **Route Tidak Ditemukan**: Jalankan `php artisan route:cache`.
- **PDF Tidak Terdownload**: Pastikan `barryvdh/laravel-dompdf` terinstall dan cek log `storage/logs/laravel.log`.

## Dependensi Utama

- Laravel 12
- Laravel Breeze (autentikasi)
- Spatie Laravel Permission (role management)
- Tailwind CSS (styling)
- Chart.js (grafik)
- barryvdh/laravel-dompdf (PDF export)
