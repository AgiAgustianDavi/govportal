@extends('layouts.admin')

@section('title', 'Dasbor')
@section('page-title', 'Dasbor')

@section('content')
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <p class="text-xs text-gray-400 mb-1">Total Pengaduan</p>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <p class="text-xs text-gray-400 mb-1">Menunggu</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $stats['menunggu'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <p class="text-xs text-gray-400 mb-1">Diproses</p>
        <p class="text-2xl font-bold text-blue-600">{{ $stats['diproses'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <p class="text-xs text-gray-400 mb-1">Selesai</p>
        <p class="text-2xl font-bold text-green-600">{{ $stats['selesai'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <p class="text-xs text-gray-400 mb-1">Ditolak</p>
        <p class="text-2xl font-bold text-red-600">{{ $stats['ditolak'] }}</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class="font-semibold">Pengaduan Terbaru</h2>
        <a href="{{ route('admin.complaints.index') }}" class="text-sm text-primary-700 font-medium hover:underline">Lihat semua &rarr;</a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-gray-400 border-b border-gray-100">
                <th class="px-5 py-3 font-medium">Tiket</th>
                <th class="px-5 py-3 font-medium">Pelapor</th>
                <th class="px-5 py-3 font-medium">Kategori</th>
                <th class="px-5 py-3 font-medium">Status</th>
                <th class="px-5 py-3 font-medium"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentComplaints as $complaint)
                <tr class="border-b border-gray-50 last:border-0">
                    <td class="px-5 py-3 font-medium text-gray-700">{{ $complaint->ticket_number }}</td>
                    <td class="px-5 py-3">{{ $complaint->name }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $complaint->category->name }}</td>
                    <td class="px-5 py-3">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $complaint->statusBadgeClass() }}">{{ $complaint->statusLabel() }}</span>
                    </td>
                    <td class="px-5 py-3 text-right">
                        <a href="{{ route('admin.complaints.show', $complaint) }}" class="text-primary-700 hover:underline">Detail</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-6 text-center text-gray-400">Belum ada pengaduan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
