# 🌊 WaveRider Jetski Rental

![Aesthetic](https://img.shields.io/badge/Aesthetic-Dark%20Glassmorphism-blue?style=for-the-badge)
![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Midtrans](https://img.shields.io/badge/Midtrans-Payment-00A9E0?style=for-the-badge)

Sebuah platform web premium untuk pemesanan (booking) dan manajemen rental Jetski yang beroperasi di wilayah teluk Jakarta (Seadoo Safari Baywalk). Aplikasi ini dirancang dengan estetika antarmuka **Dark Glassmorphism** yang elegan, responsif, dan mutakhir.

> 🤖 **Developer Note:**  
> Proyek ini dibesarkan murni melalui kultur **VibeCoding**. Sekitar **70%** dari struktur *codebase*, perombakan desain antarmuka, hingga logika sistem pembayaran dan *error handling* sepenuhnya disuntikkan secara otomatis dengan dukungan asisten kecerdasan buatan (AI). Tolong jangan cop saya sebagai "*Programmer* Tradisional"—saya hanya seorang *Pro Vibe-Coder* penikmat keindahan karya algoritma AI! 🎵💻

---

## ✨ Fitur Utama (Core Features)

1. **Premium Hero & Dynamic Package Slider**: Desain *Home* bergaya modern *full-bleed* yang dioptimasi dengan presisi CSS tingkat tinggi serta integrasi Swiper.js untuk kemudahan melihat katalog paket Jetski.
2. **Automated Payment Gateway**: Terintegrasi penuh bersama **Midtrans API**. Pesanan (*Booking*) secara dinamis digenerate melalui Snap Token dan dibayar via beragam metode (*E-Wallet*, QRIS, Transfer Bank). Cukup set up *keys*, sistem akan bekerja mandiri!
3. **Webhook Notification Sync**: Pembayaran disinkronisasi melalui *webhook callback / notification listener* secara *real-time* untuk memperbarui otomatis status lunas & valid pada sisi admin.
4. **PDF E-Ticket & Invoicing**: Begitu lunas, Admin atau Pengguna dapat langsung men-*download* *(Generate PDF menggunakan TCPDF)* Bukti Sewa (Invoice PDF) siap cetak dan estetik.
5. **Dashboard Admin**: Panel administratif bertenaga yang dapat menangani Manajemen Pengguna (*User*), Profil Pelanggan, Verifikasi Pesanan (*CRUD*), serta pengelolaan Katalog Jetski Package.

---

## 🛠 Tech Stack

- **Backend**: Laravel 11.x (PHP 8.2+)
- **Frontend**: Blade Templating Engine, Tailwind CSS (Vanilla utilities tanpa Node compiler yang repot), AlpineJS/Vanilla JS (Slider & Navigation).
- **Payment Gateway**: Midtrans (PHP Client & Snap JS)
- **PDF Generation**: TCPDF
- **Database**: MySQL (Bisa menggunakan Herd / XAMPP / Laragon).

---

## 🚀 Panduan Instalasi (Development Setup)

Berikut adalah panduan instalasi lokal menggunakan **Laravel Herd** (Atau server lokal lainnya):

1. **Clone & Buat Database**  
   Siapkan database lokal Anda (misalnya dengan nama `Jetski1_rental`) memalui Herd, TablePlus, phpMyAdmin, dsb.

2. **Buka Terminal di Folder Proyek**
   Install semua depedensi bawaan PHP dan Node (Opsional):
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Duplikat Environment**
   Salin berkas konfigurasi env:
   ```bash
   cp .env.example .env
   ```

4. **Konfigurasi Lingkungan (`.env`)**
   Buka file `.env` di Code Editor (*DevSense/VSCode*) Anda, dan sesuaikan *credentials* database.
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.0
   DB_PORT=3306
   DB_DATABASE=Jetski1_rental
   DB_USERNAME=root     # atau sesuai username Herd Anda
   DB_PASSWORD=         # kosongkan jika Herd default
   ```

5. **Generate App Key & Migrasi Struktur Database**
   Bangun fundamental struktur tabel dan berikan data dasar (Dummy Data Admin & Paket) melalu seeder:
   ```bash
   php artisan key:generate
   php artisan migrate:fresh --seed
   ```

6. **Konfigurasi Kunci Midtrans (Wajib jika ingin mencoba pembayaran!)**  
   Daftar dan masuk ke dasbor [Simulator Midtrans](https://dashboard.midtrans.com/register). Pergi ke **Settings > Access Keys** dan salin kunci-kunci sandbox tersebut lalu tempel ke `.env` Anda:
   ```ini
   MIDTRANS_SERVER_KEY="SB-Mid-server-xxxxxxxxx"
   MIDTRANS_CLIENT_KEY="SB-Mid-client-xxxxxxxxx"
   MIDTRANS_IS_PRODUCTION=false
   MIDTRANS_IS_SANITIZED=true
   MIDTRANS_IS_3DS=true
   ```

---

## 🔁 Konfigurasi Webhook Callback (Pembayaran Lokal)

Karena fitur notifikasi Midtrans meminta kembalian (Ping) dari publik ke *server* Anda, *localhost* normal tidak akan bisa menerimanya. Lakukan trik Expose port:

1. **Gunakan alat Expose seperti Ngrok / Herd Expose:**
   ```bash
   # Bila menggunakan Herd:
   herd share
   
   # Bila Ngrok:
   ngrok http 80
   ```
2. Dari Tautan Publik sementara yang dihasilkan tadi (Misal: `https://abcd.herd.net`), kopi URL tersebut dan pergi ke **Midtrans Dashboard > Settings > Configuration**.
3. Di isian **Payment Notification URL**, isi dengan:
   `https://abcd.herd.net/api/midtrans/webhook` 
4. Simpan, dan voila! Segala status pembayaran otomatis tertangkap di lokal!

---

## 🔒 Default Akun Login (Hasil Seeding)

Jika Anda mengikuti langkah menjalankan `--seed`, sistem sudah menyediakan dua jenis profil contoh bawaan:

- **Role: Super Administrator**
  - Akses fitur penuh (Melihat dashboard, Create Paket, Manage Pengguna)
  - **Email**: `admin@test.com`
  - **Password**: `password`

- **Role: Pelanggan (Customer)**
  - Akses fitur booking dan download e-ticket
  - **Email**: `jane@example.com`
  - **Password**: `password`

---

*Made effortlessly smooth during late night VibeCoding sessions. Enjoy conquering the waves!* 🛥️
