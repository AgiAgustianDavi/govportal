@extends('layouts.app')

@section('title', 'Login Petugas')

@section('content')
<section class="max-w-md mx-auto px-4 py-16">
    <h1 class="text-2xl font-bold mb-2 text-center">Login Petugas / Admin</h1>
    <p class="text-gray-500 mb-8 text-center">Khusus untuk petugas dan administrator instansi.</p>

    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="bg-white border border-gray-200 rounded-xl p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required autofocus>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kata Sandi</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
        </div>
        <label class="flex items-center gap-2 text-sm text-gray-600">
            <input type="checkbox" name="remember"> Ingat saya
        </label>
        <button type="submit" class="w-full bg-primary-700 hover:bg-primary-800 text-white font-semibold py-2.5 rounded-lg transition">Masuk</button>
    </form>

    <div class="mt-6 text-xs text-gray-400 text-center bg-gray-50 border border-gray-200 rounded-lg p-3">
        Akun contoh (seeder): <br>
        admin@instansi.go.id / password <br>
        petugas@instansi.go.id / password
    </div>
</section>
@endsection
