<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd',
                            400: '#60a5fa', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8',
                            800: '#1e40af', 900: '#1e3a8a',
                        },
                    },
                },
            },
        }
    </script>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    {{-- Top bar --}}
    <div class="bg-primary-900 text-white text-xs py-1.5">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <span>Situs Resmi Pemerintah — Melayani Sepenuh Hati</span>
            <span>{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    {{-- Navbar --}}
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <nav class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-primary-800 text-lg">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-primary-700 text-white">🏛️</span>
                {{ config('app.name') }}
            </a>
            <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-primary-700 {{ request()->routeIs('home') ? 'text-primary-700' : '' }}">Beranda</a>
                <a href="{{ route('services') }}" class="hover:text-primary-700 {{ request()->routeIs('services') ? 'text-primary-700' : '' }}">Layanan</a>
                <a href="{{ route('announcements.index') }}" class="hover:text-primary-700 {{ request()->routeIs('announcements.*') ? 'text-primary-700' : '' }}">Pengumuman</a>
                <a href="{{ route('complaints.track.form') }}" class="hover:text-primary-700 {{ request()->routeIs('complaints.track*') ? 'text-primary-700' : '' }}">Cek Pengaduan</a>
                <a href="{{ route('about') }}" class="hover:text-primary-700 {{ request()->routeIs('about') ? 'text-primary-700' : '' }}">Tentang</a>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('complaints.create') }}" class="hidden sm:inline-block bg-primary-700 hover:bg-primary-800 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">Buat Pengaduan</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-primary-700">Dasbor</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-primary-700">Login Petugas</a>
                @endauth
            </div>
        </nav>
    </header>

    {{-- Flash messages --}}
    <div class="max-w-7xl mx-auto w-full px-4">
        @if (session('success'))
            <div class="mt-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-primary-900 text-primary-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">
            <div>
                <h3 class="text-white font-semibold mb-2">{{ config('app.name') }}</h3>
                <p class="text-primary-200">Portal resmi layanan publik dan pengaduan masyarakat. Kami berkomitmen memberikan pelayanan yang transparan, cepat, dan akuntabel.</p>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-2">Tautan Cepat</h3>
                <ul class="space-y-1 text-primary-200">
                    <li><a href="{{ route('complaints.create') }}" class="hover:text-white">Buat Pengaduan</a></li>
                    <li><a href="{{ route('complaints.track.form') }}" class="hover:text-white">Cek Status Pengaduan</a></li>
                    <li><a href="{{ route('announcements.index') }}" class="hover:text-white">Pengumuman</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-2">Kontak</h3>
                <ul class="space-y-1 text-primary-200">
                    <li>Jl. Pemerintahan No. 1, Kota Contoh</li>
                    <li>Telp: (021) 000-0000</li>
                    <li>Email: layanan@instansi.go.id</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-primary-800 text-center text-xs text-primary-300 py-4">
            &copy; {{ now()->year }} {{ config('app.name') }}. Seluruh hak cipta dilindungi.
        </div>
    </footer>
</body>
</html>
