<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@instansi.go.id',
            'password' => 'password',
            'role' => User::ROLE_ADMIN,
        ]);

        $petugas = User::create([
            'name' => 'Petugas Layanan',
            'email' => 'petugas@instansi.go.id',
            'password' => 'password',
            'role' => User::ROLE_PETUGAS,
        ]);

        $categories = collect([
            ['name' => 'Pelayanan Administrasi Kependudukan', 'description' => 'Pengaduan terkait KTP, KK, akta, dan dokumen kependudukan lainnya.'],
            ['name' => 'Infrastruktur & Fasilitas Umum', 'description' => 'Pengaduan terkait jalan rusak, penerangan jalan, dan fasilitas umum.'],
            ['name' => 'Pelayanan Kesehatan', 'description' => 'Pengaduan terkait layanan Puskesmas dan fasilitas kesehatan.'],
            ['name' => 'Perizinan Usaha', 'description' => 'Pengaduan terkait proses perizinan usaha dan investasi.'],
            ['name' => 'Lainnya', 'description' => 'Pengaduan atau masukan umum lainnya.'],
        ])->map(fn ($c) => Category::create($c));

        Announcement::create([
            'title' => 'Jam Pelayanan Selama Bulan Ini',
            'content' => "Diinformasikan kepada seluruh masyarakat bahwa jam pelayanan loket buka pukul 08.00 - 15.00 WIB dari Senin sampai Jumat. Layanan pengaduan daring tetap dapat diakses 24 jam melalui portal ini.",
            'published_at' => now()->subDays(3),
        ]);

        Announcement::create([
            'title' => 'Pemeliharaan Sistem Terjadwal',
            'content' => "Akan dilakukan pemeliharaan sistem pada akhir pekan ini. Beberapa layanan daring mungkin mengalami gangguan sementara. Mohon maaf atas ketidaknyamanannya.",
            'published_at' => now()->subDay(),
        ]);

        $sample = Complaint::create([
            'category_id' => $categories->first()->id,
            'name' => 'Budi Santoso',
            'email' => 'budi.contoh@example.com',
            'phone' => '081234567890',
            'subject' => 'Proses cetak KTP lama',
            'description' => 'Sudah mengajukan permohonan cetak KTP sejak 2 minggu lalu namun belum ada kabar.',
            'status' => Complaint::STATUS_DIPROSES,
            'assigned_to' => $petugas->id,
        ]);

        $sample->responses()->create([
            'user_id' => $petugas->id,
            'message' => 'Terima kasih atas laporannya. Kami sedang menindaklanjuti ke bagian percetakan dokumen.',
        ]);

        Complaint::create([
            'category_id' => $categories[1]->id,
            'name' => 'Siti Aminah',
            'email' => 'siti.contoh@example.com',
            'phone' => '081298765432',
            'subject' => 'Lampu jalan mati di depan kantor kelurahan',
            'description' => 'Sudah sekitar 1 minggu lampu jalan di depan kantor kelurahan tidak menyala, membahayakan pengendara di malam hari.',
            'status' => Complaint::STATUS_MENUNGGU,
        ]);
    }
}
