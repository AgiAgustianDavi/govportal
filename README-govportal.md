<div align="center">

# 🏛️ GovPortal — Portal Layanan Publik & Pengaduan Masyarakat

**Aplikasi web pengaduan masyarakat & informasi layanan publik**, dibangun dengan Laravel — lengkap dengan sistem tiket pengaduan, manajemen layanan, dan dashboard petugas/admin.

[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![SQLite](https://img.shields.io/badge/Database-SQLite-003B57?style=flat&logo=sqlite&logoColor=white)](https://sqlite.org)
[![Tailwind](https://img.shields.io/badge/Tailwind_CSS-CDN-06B6D4?style=flat&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

[Lihat Demo](#-demo) · [Laporkan Bug](../../issues) · [Ajukan Fitur](../../issues)

</div>

---

## 📖 Tentang Project

**GovPortal** adalah aplikasi web yang dirancang sebagai contoh sistem digital untuk instansi pemerintah/kelurahan/dinas, memungkinkan masyarakat untuk:
- Melihat informasi layanan yang tersedia
- Mengajukan pengaduan secara online lengkap dengan lampiran
- Melacak status pengaduan mereka menggunakan **nomor tiket unik**

Sementara di sisi internal, staf instansi (dengan dua tingkat akses — **admin** dan **petugas**) dapat mengelola seluruh alur pengaduan dari satu dashboard terpusat.

---

## 🎬 Demo

![Demo GovPortal](doc/demo.gif)

> _Jika GIF di atas tidak muncul, pastikan nama file di folder `doc/` sesuai (misalnya `doc/demo.gif`) — sesuaikan path di baris ini kalau nama file Anda berbeda._

---

## ✨ Fitur

### 🌐 Halaman Publik
- **Landing page** — hero section, kategori layanan, pengumuman terbaru
- **Daftar Layanan** — informasi kategori layanan yang tersedia di instansi
- **Tentang Instansi** — profil, visi & misi
- **Pengumuman** — daftar & detail pengumuman resmi
- **Form Pengaduan** — masyarakat bisa mengajukan pengaduan lengkap dengan **upload lampiran**
- **Cek Status Pengaduan** — lacak progres pengaduan cukup dengan nomor tiket, tanpa perlu login

### 🔐 Sistem Peran (Role-Based Access)

| Role | Akses |
|---|---|
| **admin** | Semua fitur backend, termasuk kelola akun pengguna |
| **petugas** | Semua fitur backend, **kecuali** kelola akun pengguna |

### 🛠️ Dashboard Admin/Petugas (`/admin`)
- **Dashboard statistik** pengaduan (ringkasan real-time)
- **Manajemen Kategori Layanan** — CRUD kategori
- **Manajemen Pengaduan** — filter, lihat detail, ubah status, beri tanggapan resmi ke pelapor
- **Manajemen Pengumuman** — CRUD pengumuman untuk publik
- **Manajemen Akun Pengguna** — kelola akun admin/petugas *(khusus role admin)*

### 🎫 Sistem Tiket Otomatis
Setiap pengaduan yang masuk otomatis mendapat nomor tiket unik dengan format:
```
ADU-YYYYMMDD-XXXXX
```
sehingga pelapor bisa melacak statusnya kapan saja tanpa perlu akun.

---

## 🧰 Teknologi yang Digunakan

| Kategori | Teknologi |
|---|---|
| **Backend Framework** | [Laravel 13](https://laravel.com) (PHP 8.3+) |
| **Template Engine** | Blade (server-side rendering, tanpa Livewire/Vue/React) |
| **Database** | SQLite |
| **Frontend Styling** | Tailwind CSS via **CDN** — tanpa proses build (`npm`/`vite`) |
| **Autentikasi** | Laravel Session Auth + custom Role Middleware |
| **Arsitektur** | MVC (Model-View-Controller) |

---

## 🚀 Cara Instalasi

### Kebutuhan Sistem
- PHP >= 8.3
- Composer
- Ekstensi PHP: `sqlite3`, `pdo_sqlite`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`

### Langkah-langkah

```bash
# 1. Clone repository
git clone https://github.com/AgiAgustianDavi/govportal.git
cd govportal

# 2. Install dependency PHP
composer install

# 3. Salin file environment
cp .env.example .env          # Windows CMD: copy .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Pastikan file database SQLite ada
touch database/database.sqlite               # Linux/Mac
# Windows PowerShell:
# New-Item database/database.sqlite -ItemType File

# 6. Jalankan migrasi & seeder (data contoh: akun, kategori, pengaduan)
php artisan migrate --seed

# 7. Buat symbolic link storage (untuk lampiran pengaduan)
php artisan storage:link

# 8. Jalankan server lokal
php artisan serve
```

Buka **http://127.0.0.1:8000** di browser. 🎉

### 🔑 Akun Contoh (dari Seeder)

| Role    | Email                     | Password   |
|---------|----------------------------|------------|
| Admin   | `admin@instansi.go.id`     | `password` |
| Petugas | `petugas@instansi.go.id`   | `password` |

Login backend melalui: `/login`

> ⚠️ **Untuk production**, segera ganti password akun default ini.

---

## 🗺️ Peta Rute (Routes)

### Publik (Frontend)
| Route | Keterangan |
|---|---|
| `/` | Landing page (hero, kategori layanan, pengumuman terbaru) |
| `/layanan` | Daftar kategori layanan |
| `/tentang` | Profil instansi (visi & misi) |
| `/pengumuman` | Daftar pengumuman |
| `/pengumuman/{slug}` | Detail pengumuman |
| `/pengaduan/buat` | Form pengajuan pengaduan (dengan upload lampiran) |
| `/pengaduan/cek` | Cek status pengaduan via nomor tiket |

### Admin/Petugas (Backend — prefix `/admin`)
| Route | Keterangan |
|---|---|
| `/admin` | Dashboard statistik pengaduan |
| `/admin/categories` | CRUD kategori layanan |
| `/admin/complaints` | Daftar & filter pengaduan, detail, ubah status, tanggapan |
| `/admin/announcements` | CRUD pengumuman |
| `/admin/users` | CRUD akun pengguna *(khusus admin)* |

---

## 📁 Struktur Folder

```
app/
├── Http/Controllers/
│   ├── Public/            # Controller halaman publik
│   └── Admin/              # Controller dashboard admin/petugas
├── Http/Middleware/
│   └── RoleMiddleware.php  # Proteksi akses berdasarkan role
└── Models/                 # Complaint, Category, Announcement, ComplaintResponse, User

database/
├── migrations/              # Struktur tabel
└── seeders/                 # Data awal (akun + contoh pengaduan/kategori)

resources/views/
├── layouts/                 # Layout publik & admin
├── public/                  # Halaman publik
└── admin/                   # Halaman dashboard admin/petugas
```

---

## 📝 Catatan Teknis

- Styling memakai **Tailwind CSS via CDN** — tidak perlu Node.js/`npm install` sama sekali
- Lampiran pengaduan tersimpan di `storage/app/public/complaints` — pastikan sudah menjalankan `php artisan storage:link`
- Nomor tiket digenerate otomatis dengan format `ADU-YYYYMMDD-XXXXX`

---

## 🗺️ Roadmap / Pengembangan Selanjutnya

- [ ] Verifikasi email untuk akun petugas (middleware `verified`)
- [ ] Export laporan pengaduan ke Excel/PDF
- [ ] Grafik statistik dashboard (Chart.js)
- [ ] Notifikasi email otomatis saat status pengaduan berubah
- [ ] Multi-bahasa (ID/EN)

---

## 🤝 Kontribusi

Kontribusi, isu, dan permintaan fitur sangat diterima!
Silakan buka [issue](../../issues) atau kirim [pull request](../../pulls).

## 📄 Lisensi

Project ini menggunakan lisensi [MIT](LICENSE).

---

<div align="center">

Dibuat dengan ❤️ menggunakan Laravel — untuk digitalisasi layanan publik yang lebih baik

</div>
