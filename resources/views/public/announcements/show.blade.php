@extends('layouts.app')

@section('title', $announcement->title)

@section('content')
<section class="max-w-3xl mx-auto px-4 py-14">
    <a href="{{ route('announcements.index') }}" class="text-primary-700 text-sm font-medium hover:underline">&larr; Kembali ke Pengumuman</a>

    <div class="bg-white border border-gray-200 rounded-xl p-8 mt-4">
        <span class="text-xs text-gray-400">{{ $announcement->published_at->translatedFormat('d F Y') }}</span>
        <h1 class="text-2xl font-bold mt-1 mb-4">{{ $announcement->title }}</h1>
        <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $announcement->content }}</div>
    </div>
</section>
@endsection
