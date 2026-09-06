@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
<section class="max-w-4xl mx-auto px-4 py-14">
    <h1 class="text-2xl font-bold mb-8">Pengumuman</h1>

    <div class="space-y-4">
        @forelse ($announcements as $announcement)
            <a href="{{ route('announcements.show', $announcement) }}" class="block bg-white border border-gray-200 rounded-xl p-5 hover:shadow-md transition">
                <span class="text-xs text-gray-400">{{ $announcement->published_at->translatedFormat('d F Y') }}</span>
                <h2 class="font-semibold text-gray-800 mt-1 mb-2">{{ $announcement->title }}</h2>
                <p class="text-sm text-gray-500">{{ Str::limit(strip_tags($announcement->content), 150) }}</p>
            </a>
        @empty
            <p class="text-gray-400 text-sm">Belum ada pengumuman.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $announcements->links() }}
    </div>
</section>
@endsection
