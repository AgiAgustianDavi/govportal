@extends('layouts.app')

@section('title', 'Cek Status Pengaduan')

@section('content')
<section class="max-w-lg mx-auto px-4 py-16">
    <h1 class="text-2xl font-bold mb-2 text-center">Cek Status Pengaduan</h1>
    <p class="text-gray-500 mb-8 text-center">Masukkan nomor tiket yang Anda terima saat mengajukan pengaduan.</p>

    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('complaints.track') }}" class="bg-white border border-gray-200 rounded-xl p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Nomor Tiket</label>
            <input type="text" name="ticket_number" placeholder="ADU-20260101-XXXXX" value="{{ old('ticket_number') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
        </div>
        <button type="submit" class="w-full bg-primary-700 hover:bg-primary-800 text-white font-semibold py-2.5 rounded-lg transition">Cek Status</button>
    </form>
</section>
@endsection
