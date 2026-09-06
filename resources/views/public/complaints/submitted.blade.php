@extends('layouts.app')

@section('title', 'Pengaduan Terkirim')

@section('content')
<section class="max-w-xl mx-auto px-4 py-16 text-center">
    <div class="text-5xl mb-4">✅</div>
    <h1 class="text-2xl font-bold mb-2">Pengaduan Berhasil Dikirim</h1>
    <p class="text-gray-500 mb-6">Simpan nomor tiket berikut untuk memantau status pengaduan Anda.</p>

    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-8">
        <p class="text-sm text-gray-500 mb-1">Nomor Tiket Anda</p>
        <p class="text-2xl font-bold text-primary-800 tracking-wider">{{ $complaint->ticket_number }}</p>
    </div>

    <div class="flex justify-center gap-3">
        <a href="{{ route('complaints.track.form') }}" class="bg-primary-700 hover:bg-primary-800 text-white font-semibold px-5 py-3 rounded-lg">Cek Status Sekarang</a>
        <a href="{{ route('home') }}" class="border border-gray-300 text-gray-700 font-semibold px-5 py-3 rounded-lg hover:bg-gray-50">Kembali ke Beranda</a>
    </div>
</section>
@endsection
