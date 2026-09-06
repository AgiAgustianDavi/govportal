<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasbor Admin') - {{ config('app.name') }}</title>
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
</head>
<body class="bg-gray-100 text-gray-800">
<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-gray-200 flex flex-col shrink-0">
        <div class="px-5 py-4 border-b border-gray-800">
            <a href="{{ route('admin.dashboard') }}" class="font-bold text-white text-lg flex items-center gap-2">
                <span>🏛️</span> Panel Admin
            </a>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary-700 text-white' : 'hover:bg-gray-800' }}">📊 Dasbor</a>
            <a href="{{ route('admin.complaints.index') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('admin.complaints.*') ? 'bg-primary-700 text-white' : 'hover:bg-gray-800' }}">📨 Pengaduan</a>
            <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-primary-700 text-white' : 'hover:bg-gray-800' }}">🗂️ Kategori Layanan</a>
            <a href="{{ route('admin.announcements.index') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('admin.announcements.*') ? 'bg-primary-700 text-white' : 'hover:bg-gray-800' }}">📢 Pengumuman</a>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-primary-700 text-white' : 'hover:bg-gray-800' }}">👤 Akun Pengguna</a>
            @endif
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-800">🌐 Lihat Situs Publik</a>
        </nav>
        <div class="px-3 py-4 border-t border-gray-800">
            <div class="px-3 pb-2 text-xs text-gray-400">
                Masuk sebagai<br>
                <span class="text-white font-medium">{{ auth()->user()->name }}</span>
                <span class="block text-gray-500">({{ ucfirst(auth()->user()->role) }})</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-800 text-red-300 text-sm">🚪 Keluar</button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow-sm px-6 py-4">
            <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dasbor')</h1>
        </header>

        <main class="flex-1 p-6">
            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
