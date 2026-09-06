@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('page-title', 'Kelola Pengumuman')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('admin.announcements.create') }}" class="bg-primary-700 hover:bg-primary-800 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Tambah Pengumuman</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-gray-400 border-b border-gray-100">
                <th class="px-5 py-3 font-medium">Judul</th>
                <th class="px-5 py-3 font-medium">Tanggal Terbit</th>
                <th class="px-5 py-3 font-medium">Status</th>
                <th class="px-5 py-3 font-medium"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($announcements as $announcement)
                <tr class="border-b border-gray-50 last:border-0">
                    <td class="px-5 py-3 font-medium text-gray-700">{{ $announcement->title }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $announcement->published_at?->translatedFormat('d F Y, H:i') ?? '-' }}</td>
                    <td class="px-5 py-3">
                        @if ($announcement->published_at && $announcement->published_at->isPast())
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-800">Terbit</span>
                        @else
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-600">Draf</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-right space-x-3">
                        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-primary-700 hover:underline">Ubah</a>
                        <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengumuman ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-6 text-center text-gray-400">Belum ada pengumuman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $announcements->links() }}</div>
@endsection
