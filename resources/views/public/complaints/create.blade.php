@extends('layouts.app')

@section('title', 'Buat Pengaduan')

@section('content')
<section class="max-w-2xl mx-auto px-4 py-14">
    <h1 class="text-2xl font-bold mb-2">Formulir Pengaduan</h1>
    <p class="text-gray-500 mb-8">Sampaikan pengaduan Anda dengan lengkap dan jelas agar dapat kami tindaklanjuti dengan cepat.</p>

    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data" class="bg-white border border-gray-200 rounded-xl p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Kategori Pengaduan</label>
            <select name="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', request('category')) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nomor Telepon (opsional)</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Subjek</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Uraian Pengaduan</label>
            <textarea name="description" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Lampiran (opsional, maks. 2MB — jpg/png/pdf)</label>
            <input type="file" name="attachment" class="w-full text-sm">
        </div>

        <button type="submit" class="w-full bg-primary-700 hover:bg-primary-800 text-white font-semibold py-2.5 rounded-lg transition">Kirim Pengaduan</button>
    </form>
</section>
@endsection
