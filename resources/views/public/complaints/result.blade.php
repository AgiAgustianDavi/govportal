@extends('layouts.app')

@section('title', 'Hasil Pengecekan')

@section('content')
<section class="max-w-2xl mx-auto px-4 py-14">
    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-xs text-gray-400">Nomor Tiket</p>
                <p class="font-bold text-primary-800 text-lg">{{ $complaint->ticket_number }}</p>
            </div>
            <span class="text-xs font-semibold px-3 py-1.5 rounded-full {{ $complaint->statusBadgeClass() }}">{{ $complaint->statusLabel() }}</span>
        </div>
        <dl class="text-sm divide-y divide-gray-100">
            <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Kategori</dt><dd class="col-span-2">{{ $complaint->category->name }}</dd></div>
            <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Subjek</dt><dd class="col-span-2">{{ $complaint->subject }}</dd></div>
            <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Pelapor</dt><dd class="col-span-2">{{ $complaint->name }}</dd></div>
            <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Tanggal</dt><dd class="col-span-2">{{ $complaint->created_at->translatedFormat('d F Y, H:i') }}</dd></div>
            <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Uraian</dt><dd class="col-span-2">{{ $complaint->description }}</dd></div>
        </dl>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <h2 class="font-semibold mb-4">Riwayat Tanggapan</h2>
        @forelse ($complaint->responses as $response)
            <div class="border-l-2 border-primary-200 pl-4 pb-4 mb-4 last:mb-0 last:pb-0">
                <p class="text-sm text-gray-700">{{ $response->message }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $response->user->name }} &middot; {{ $response->created_at->translatedFormat('d F Y, H:i') }}</p>
            </div>
        @empty
            <p class="text-sm text-gray-400">Belum ada tanggapan dari petugas.</p>
        @endforelse
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('complaints.track.form') }}" class="text-primary-700 text-sm font-medium hover:underline">&larr; Cek nomor tiket lain</a>
    </div>
</section>
@endsection
