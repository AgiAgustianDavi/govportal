@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')
@section('page-title', 'Tambah Pengumuman')

@section('content')
<div class="max-w-2xl bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <form method="POST" action="{{ route('admin.announcements.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Isi Pengumuman</label>
            <textarea name="content" rows="6" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>{{ old('content') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Terbit (kosongkan untuk simpan sebagai draf)</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-primary-700 hover:bg-primary-800 text-white font-semibold px-5 py-2.5 rounded-lg">Simpan</button>
            <a href="{{ route('admin.announcements.index') }}" class="text-gray-600 px-5 py-2.5">Batal</a>
        </div>
    </form>
</div>
@endsection
