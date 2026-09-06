# Portal Layanan Publik & Pengaduan Masyarakat

Aplikasi web berbasis **Laravel 13** dengan **Blade** (server-side rendering) dan **SQLite**,
dirancang sebagai contoh proyek portofolio untuk instansi pemerintah. Terdiri dari:

- **Frontend (publik):** landing page instansi, daftar layanan, form pengaduan, cek status
  pengaduan via nomor tiket, dan halaman pengumuman.
- **Backend (admin/petugas):** dashboard statistik, manajemen kategori layanan, manajemen
  pengaduan (verifikasi, ubah status, tanggapi), manajemen pengumuman, dan manajemen akun
  pengguna (admin only).

## Struktur Peran

| Role     | Akses                                                             |
|----------|--------------------------------------------------------------------|
| admin    | Semua fitur backend, termasuk kelola akun pengguna                |
| petugas  | Semua fitur backend kecuali kelola akun pengguna                  |

## Persyaratan

- PHP 8.3+
- Composer
- Ekstensi PHP: `sqlite3`, `pdo_sqlite`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`

## Instalasi

```bash
# 1. Masuk ke folder project
cd govportal

# 2. Install dependency PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Pastikan file database SQLite ada (biasanya sudah tersedia kosong)
touch database/database.sqlite

# 6. Jalankan migrasi + seeder (data contoh: akun, kategori, pengaduan)
php artisan migrate --seed

# 7. Buat symlink storage (untuk lampiran pengaduan)
php artisan storage:link

# 8. Jalankan server lokal
php artisan serve
```

Buka `http://localhost:8000` di browser.

## Akun Contoh (dari Seeder)

| Role     | Email                      | Password  |
|----------|-----------------------------|-----------|
| Admin    | admin@instansi.go.id        | password  |
| Petugas  | petugas@instansi.go.id      | password  |

Login backend melalui: `http://localhost:8000/login`

## Struktur Fitur

### Publik (Frontend)
- `/` — Landing page (hero, kategori layanan, pengumuman terbaru)
- `/layanan` — Daftar kategori layanan
- `/tentang` — Profil instansi (visi & misi)
- `/pengumuman` — Daftar pengumuman
- `/pengumuman/{slug}` — Detail pengumuman
- `/pengaduan/buat` — Form pengajuan pengaduan (dengan upload lampiran)
- `/pengaduan/cek` — Cek status pengaduan via nomor tiket

### Admin/Petugas (Backend) — prefix `/admin`
- `/admin` — Dashboard statistik pengaduan
- `/admin/categories` — CRUD kategori layanan
- `/admin/complaints` — Daftar & filter pengaduan, detail, ubah status, beri tanggapan
- `/admin/announcements` — CRUD pengumuman
- `/admin/users` — CRUD akun pengguna (khusus admin)

## Catatan Teknis

- Styling menggunakan **Tailwind CSS via CDN** — tidak perlu proses build (`npm install`/`vite`),
  jadi bisa langsung dijalankan tanpa Node.js.
- Nomor tiket pengaduan digenerate otomatis dengan format `ADU-YYYYMMDD-XXXXX`.
- Lampiran pengaduan disimpan di `storage/app/public/complaints` — pastikan sudah
  menjalankan `php artisan storage:link`.
- Jika ingin mengganti tema warna, tema, atau menambah fitur (misalnya export laporan
  PDF/Excel, notifikasi email, atau multi-bahasa), struktur ini sudah cukup rapi untuk
  dikembangkan lebih lanjut.

## Pengembangan Lanjutan (opsional)

- Tambah middleware `verified` bila ingin verifikasi email untuk akun petugas.
- Tambah export laporan pengaduan ke Excel/PDF (bisa pakai `maatwebsite/excel` atau `barryvdh/laravel-dompdf`).
- Tambah grafik statistik di dashboard dengan Chart.js (CDN, tanpa build step).
- Tambah notifikasi email otomatis ke pelapor saat status pengaduan berubah.
