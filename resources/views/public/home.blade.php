@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- Hero --}}
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-20 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4">Melayani Masyarakat dengan Transparan &amp; Cepat</h1>
                <p class="text-primary-100 mb-8">Sampaikan aspirasi, keluhan, atau laporan Anda melalui portal pengaduan resmi. Setiap laporan akan kami tindaklanjuti dan dapat dipantau statusnya secara daring.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('complaints.create') }}" class="bg-white text-primary-800 font-semibold px-5 py-3 rounded-lg hover:bg-primary-50 transition">Buat Pengaduan</a>
                    <a href="{{ route('complaints.track.form') }}" class="border border-white/60 text-white font-semibold px-5 py-3 rounded-lg hover:bg-white/10 transition">Cek Status Pengaduan</a>
                </div>
            </div>
            <div class="hidden md:block text-[10rem] text-center opacity-90">🏛️</div>
        </div>
    </section>

    {{-- Categories --}}
    <section class="max-w-7xl mx-auto px-4 py-14">
        <h2 class="text-2xl font-bold mb-2">Kategori Layanan</h2>
        <p class="text-gray-500 mb-8">Pilih kategori sesuai jenis pengaduan atau layanan yang Anda butuhkan.</p>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-5">
            @foreach ($categories as $category)
                <div class="bg-white border border-gray-200 rounded-xl p-5 hover:shadow-md transition">
                    <h3 class="font-semibold text-primary-800 mb-1">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ Str::limit($category->description, 90) }}</p>
                    <span class="text-xs text-gray-400">{{ $category->complaints_count }} pengaduan tercatat</span>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            <a href="{{ route('services') }}" class="text-primary-700 font-medium text-sm hover:underline">Lihat semua layanan &rarr;</a>
        </div>
    </section>

    {{-- Announcements --}}
    <section class="bg-white border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-14">
            <h2 class="text-2xl font-bold mb-2">Pengumuman Terbaru</h2>
            <p class="text-gray-500 mb-8">Informasi dan pemberitahuan resmi dari instansi kami.</p>
            <div class="grid md:grid-cols-3 gap-5">
                @forelse ($announcements as $announcement)
                    <a href="{{ route('announcements.show', $announcement) }}" class="block border border-gray-200 rounded-xl p-5 hover:shadow-md transition">
                        <span class="text-xs text-gray-400">{{ $announcement->published_at->translatedFormat('d F Y') }}</span>
                        <h3 class="font-semibold text-gray-800 mt-1 mb-2">{{ $announcement->title }}</h3>
                        <p class="text-sm text-gray-500">{{ Str::limit(strip_tags($announcement->content), 100) }}</p>
                    </a>
                @empty
                    <p class="text-gray-400 text-sm">Belum ada pengumuman.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Steps --}}
    <section class="max-w-7xl mx-auto px-4 py-14">
        <h2 class="text-2xl font-bold mb-8 text-center">Cara Menyampaikan Pengaduan</h2>
        <div class="grid md:grid-cols-3 gap-6 text-center">
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-primary-100 text-primary-700 font-bold flex items-center justify-center mx-auto mb-3">1</div>
                <h3 class="font-semibold mb-1">Isi Formulir</h3>
                <p class="text-sm text-gray-500">Lengkapi data dan uraian pengaduan Anda pada formulir daring.</p>
            </div>
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-primary-100 text-primary-700 font-bold flex items-center justify-center mx-auto mb-3">2</div>
                <h3 class="font-semibold mb-1">Dapatkan Nomor Tiket</h3>
                <p class="text-sm text-gray-500">Simpan nomor tiket yang diberikan untuk memantau status laporan.</p>
            </div>
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-primary-100 text-primary-700 font-bold flex items-center justify-center mx-auto mb-3">3</div>
                <h3 class="font-semibold mb-1">Pantau Tindak Lanjut</h3>
                <p class="text-sm text-gray-500">Cek status dan tanggapan petugas kapan saja melalui portal ini.</p>
            </div>
        </div>
    </section>
@endsection
