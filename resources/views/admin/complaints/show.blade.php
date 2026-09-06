@extends('layouts.admin')

@section('title', 'Detail Pengaduan')
@section('page-title', 'Detail Pengaduan')

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs text-gray-400">Nomor Tiket</p>
                    <p class="font-bold text-lg text-gray-800">{{ $complaint->ticket_number }}</p>
                </div>
                <span class="text-xs font-semibold px-3 py-1.5 rounded-full {{ $complaint->statusBadgeClass() }}">{{ $complaint->statusLabel() }}</span>
            </div>
            <dl class="text-sm divide-y divide-gray-100">
                <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Kategori</dt><dd class="col-span-2">{{ $complaint->category->name }}</dd></div>
                <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Nama Pelapor</dt><dd class="col-span-2">{{ $complaint->name }}</dd></div>
                <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Email</dt><dd class="col-span-2">{{ $complaint->email }}</dd></div>
                <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Telepon</dt><dd class="col-span-2">{{ $complaint->phone ?? '-' }}</dd></div>
                <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Subjek</dt><dd class="col-span-2">{{ $complaint->subject }}</dd></div>
                <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Uraian</dt><dd class="col-span-2">{{ $complaint->description }}</dd></div>
                @if ($complaint->attachment_path)
                    <div class="py-2 grid grid-cols-3">
                        <dt class="text-gray-500">Lampiran</dt>
                        <dd class="col-span-2"><a href="{{ \Illuminate\Support\Facades\Storage::url($complaint->attachment_path) }}" target="_blank" class="text-primary-700 hover:underline">Lihat lampiran</a></dd>
                    </div>
                @endif
                <div class="py-2 grid grid-cols-3"><dt class="text-gray-500">Tanggal Masuk</dt><dd class="col-span-2">{{ $complaint->created_at->translatedFormat('d F Y, H:i') }}</dd></div>
            </dl>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="font-semibold mb-4">Riwayat Tanggapan</h2>
            <div class="space-y-4 mb-6">
                @forelse ($complaint->responses as $response)
                    <div class="border-l-2 border-primary-200 pl-4">
                        <p class="text-sm text-gray-700">{{ $response->message }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $response->user->name }} &middot; {{ $response->created_at->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">Belum ada tanggapan.</p>
                @endforelse
            </div>

            <form method="POST" action="{{ route('admin.complaints.respond', $complaint) }}" class="space-y-3">
                @csrf
                <textarea name="message" rows="3" placeholder="Tulis tanggapan untuk pelapor..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required></textarea>
                <button type="submit" class="bg-primary-700 hover:bg-primary-800 text-white text-sm font-semibold px-4 py-2 rounded-lg">Kirim Tanggapan</button>
            </form>
        </div>
    </div>

    <div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="font-semibold mb-4">Perbarui Status</h2>
            <form method="POST" action="{{ route('admin.complaints.status', $complaint) }}" class="space-y-4">
                @csrf @method('PATCH')
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                        @foreach ($statuses as $key => $label)
                            <option value="{{ $key }}" @selected($complaint->status === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Ditugaskan Kepada</label>
                    <select name="assigned_to" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                        <option value="">-- Belum Ditugaskan --</option>
                        @foreach ($petugas as $p)
                            <option value="{{ $p->id }}" @selected($complaint->assigned_to === $p->id)>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full bg-primary-700 hover:bg-primary-800 text-white text-sm font-semibold px-4 py-2 rounded-lg">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
