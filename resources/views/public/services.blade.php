@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
<section class="max-w-5xl mx-auto px-4 py-14">
    <h1 class="text-2xl font-bold mb-2">Layanan Kami</h1>
    <p class="text-gray-500 mb-8">Berikut kategori layanan dan pengaduan yang dapat Anda ajukan melalui portal ini.</p>

    <div class="space-y-4">
        @foreach ($categories as $category)
            <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-start justify-between gap-4">
                <div>
                    <h3 class="font-semibold text-primary-800">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $category->description }}</p>
                </div>
                <a href="{{ route('complaints.create') }}?category={{ $category->id }}" class="shrink-0 text-sm font-medium text-white bg-primary-700 hover:bg-primary-800 px-4 py-2 rounded-lg">Ajukan</a>
            </div>
        @endforeach
    </div>
</section>
@endsection
