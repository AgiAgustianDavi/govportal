@extends('layouts.admin')

@section('title', 'Pengaduan')
@section('page-title', 'Kelola Pengaduan')

@section('content')
<form method="GET" class="flex flex-wrap gap-3 mb-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tiket, nama, subjek..." class="border border-gray-300 rounded-lg px-3 py-2 text-sm flex-1 min-w-[200px]">
    <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
        <option value="">Semua Status</option>
        @foreach ($statuses as $key => $label)
            <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
        @endforeach
    </select>
    <button class="bg-primary-700 hover:bg-primary-800 text-white text-sm font-semibold px-4 py-2 rounded-lg">Filter</button>
    @if (request('search') || request('status'))
        <a href="{{ route('admin.complaints.index') }}" class="text-sm text-gray-500 px-2 py-2">Reset</a>
    @endif
</form>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-gray-400 border-b border-gray-100">
                <th class="px-5 py-3 font-medium">Tiket</th>
                <th class="px-5 py-3 font-medium">Pelapor</th>
                <th class="px-5 py-3 font-medium">Kategori</th>
                <th class="px-5 py-3 font-medium">Ditugaskan</th>
                <th class="px-5 py-3 font-medium">Status</th>
                <th class="px-5 py-3 font-medium"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($complaints as $complaint)
                <tr class="border-b border-gray-50 last:border-0">
                    <td class="px-5 py-3 font-medium text-gray-700">{{ $complaint->ticket_number }}</td>
                    <td class="px-5 py-3">{{ $complaint->name }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $complaint->category->name }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $complaint->assignedTo->name ?? '-' }}</td>
                    <td class="px-5 py-3">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $complaint->statusBadgeClass() }}">{{ $complaint->statusLabel() }}</span>
                    </td>
                    <td class="px-5 py-3 text-right">
                        <a href="{{ route('admin.complaints.show', $complaint) }}" class="text-primary-700 hover:underline">Detail</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-5 py-6 text-center text-gray-400">Tidak ada pengaduan ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $complaints->links() }}</div>
@endsection
