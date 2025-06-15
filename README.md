# Aplikasi Reservasi Kendaraan

Aplikasi web sederhana yang dibangun dengan Laravel untuk mengelola proses pemesanan dan monitoring kendaraan di sebuah perusahaan tambang.

## Fitur Utama
- Manajemen data master (Kendaraan, Driver, Lokasi, Pegawai, User).
- Proses pemesanan kendaraan oleh Admin.
- Alur persetujuan berjenjang (2 level).
- Dashboard khusus untuk Approver memberikan persetujuan.
- Pencatatan riwayat pemakaian (BBM & Servis).
- Dashboard monitoring dengan visualisasi data (grafik).
- Laporan periodik yang dapat diekspor ke format Excel.
- Pencatatan log aktivitas untuk setiap proses penting.
- UI/UX yang modern dan responsif menggunakan Tailwind CSS.

## Spesifikasi Teknis
- **PHP Version**: 8.3.7
- **Framework**: Laravel 12.x
- **Database**: PostgreSQL 15
- **Frontend**: Tailwind CSS, Chart.js, Tom Select

## Panduan Instalasi
1.  Clone repositori ini: `git clone [URL_REPO_ANDA]`
2.  Masuk ke direktori proyek: `cd [NAMA_PROYEK]`
3.  Instal dependensi Composer: `composer install`
4.  Instal dependensi NPM: `npm install && npm run build`
5.  Salin file environment: `cp .env.example .env`
6.  Buat kunci aplikasi: `php artisan key:generate`
7.  Konfigurasi koneksi database Anda di dalam file `.env`.
8.  Jalankan migrasi dan seeder untuk membuat tabel dan data awal:
    ```bash
    php artisan migrate:fresh --seed
    ```
9.  Jalankan server pengembangan: `php artisan serve`

## Panduan Penggunaan

Aplikasi ini memiliki 2 peran utama yang dapat login: Admin dan Approver.

### Akun Pengguna (Default)

**1. Akun Admin**
-   **Email**: `admin@perusahaan.com`
-   **Password**: `password123`

**2. Akun Approver (Level 1)**
-   **Email**: `nana.manajer@perusahaan.com`
-   **Password**: `password123`

**3. Akun Approver (Level 2)**
-   **Email**: `nini.kepdiv@perusahaan.com`
-   **Password**: `password123`

### Alur Kerja

1.  **Admin** login ke sistem.
2.  Admin dapat mengelola data master seperti Kendaraan dan Driver.
3.  Admin membuat **Reservasi Baru** atas nama seorang pegawai. Sistem akan secara otomatis menentukan alur persetujuan ke Nana (Lvl 1) dan Nini (Lvl 2).
4.  **Nana (Approver Lvl 1)** login. Di dashboard-nya, ia akan melihat permintaan reservasi dan dapat menyetujui atau menolaknya.
5.  Jika Nana setuju, permintaan akan muncul di dashboard **Nini (Approver Lvl 2)** untuk persetujuan akhir.
6.  Setelah reservasi disetujui sepenuhnya, Admin dapat melihat statusnya menjadi "Approved".
7.  Setelah perjalanan selesai, Admin dapat menekan tombol "Selesaikan" untuk menutup reservasi dan membuat kendaraan/driver tersedia kembali.
8.  Admin dapat melihat **Laporan Reservasi** dan mengekspornya ke Excel.