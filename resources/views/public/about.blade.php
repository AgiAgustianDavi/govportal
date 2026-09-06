@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<section class="max-w-4xl mx-auto px-4 py-14">
    <h1 class="text-2xl font-bold mb-4">Tentang Instansi Kami</h1>
    <p class="text-gray-600 leading-relaxed mb-6">
        Portal Layanan Publik ini dikembangkan sebagai bagian dari komitmen instansi dalam mewujudkan
        tata kelola pemerintahan yang transparan, akuntabel, dan responsif terhadap aspirasi masyarakat.
        Melalui portal ini, masyarakat dapat menyampaikan pengaduan, memantau tindak lanjutnya secara
        daring, serta mengakses informasi dan pengumuman resmi.
    </p>

    <div class="grid md:grid-cols-2 gap-6 mt-10">
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="font-semibold text-primary-800 mb-2">Visi</h2>
            <p class="text-sm text-gray-600">Mewujudkan pelayanan publik yang profesional, transparan, dan berorientasi pada kepuasan masyarakat.</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="font-semibold text-primary-800 mb-2">Misi</h2>
            <ul class="text-sm text-gray-600 list-disc list-inside space-y-1">
                <li>Meningkatkan kualitas dan kecepatan pelayanan publik.</li>
                <li>Membangun sistem pengaduan yang mudah diakses dan transparan.</li>
                <li>Mendorong partisipasi aktif masyarakat dalam pengawasan layanan.</li>
            </ul>
        </div>
    </div>
</section>
@endsection
