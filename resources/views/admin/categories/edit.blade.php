@extends('layouts.admin')

@section('title', 'Ubah Kategori')
@section('page-title', 'Ubah Kategori')

@section('content')
<div class="max-w-xl bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">{{ old('description', $category->description) }}</textarea>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-primary-700 hover:bg-primary-800 text-white font-semibold px-5 py-2.5 rounded-lg">Perbarui</button>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-600 px-5 py-2.5">Batal</a>
        </div>
    </form>
</div>
@endsection
