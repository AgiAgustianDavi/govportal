@extends('layouts.admin')

@section('title', 'Ubah Akun')
@section('page-title', 'Ubah Akun Pengguna')

@section('content')
<div class="max-w-xl bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kata Sandi Baru (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Peran</label>
            <select name="role" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="petugas" @selected(old('role', $user->role) === 'petugas')>Petugas</option>
                <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
            </select>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-primary-700 hover:bg-primary-800 text-white font-semibold px-5 py-2.5 rounded-lg">Perbarui</button>
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 px-5 py-2.5">Batal</a>
        </div>
    </form>
</div>
@endsection
