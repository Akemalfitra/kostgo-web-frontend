@extends('layouts.app')

@section('title', 'Hasil Pencarian Kos - ' . ($lokasi ?: 'Semua Kos'))

@section('content')
<div class="container mx-auto p-4 py-8">
    <h1 class="text-3xl font-bold text-kostgo-dark-gray mb-6">
        Hasil Pencarian Kos
        @if($lokasi)
            untuk "<span class="text-kostgo-blue">{{ $lokasi }}</span>"
        @endif
    </h1>

    @if($kosts->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md" role="alert">
            <p class="font-bold">Maaf!</p>
            <p>Tidak ada kos yang ditemukan sesuai kriteria pencarian Anda. Coba lokasi lain atau filter yang berbeda.</p>
            <p class="text-sm mt-2">Anda bisa mencari di kota-kota populer seperti Bandung, Jakarta, atau Depok.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($kosts as $kost)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-200">
                    @php
                        $images = $kost->image; // Decode sebagai array asosiatif
                        $firstImage = 'https://via.placeholder.com/400x300?text=No+Image'; // Default jika tidak ada gambar
                        if (!empty($images) && is_array($images) && isset($images[0])) {
                            $firstImage = asset('storage/' . $images[0]);
                        }
                    @endphp
                    <img src="{{ $firstImage }}" alt="{{ $kost->name }}" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h2 class="text-xl font-semibold text-kostgo-dark-gray mb-2">{{ $kost->name }}</h2>
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-map-marker-alt mr-1 text-kostgo-blue"></i> {{ $kost->address }}, {{ $kost->city }}</p>
                        <p class="text-gray-600 text-sm mb-3">Tipe: <span class="font-medium text-kostgo-blue">{{ ucfirst($kost->type) }}</span></p>
                        <div class="text-2xl font-bold text-green-600 mb-4">Rp{{ number_format($kost->price, 0, ',', '.') }} <span class="text-base font-normal text-gray-500">/bulan</span></div>
                        <a href={{ route('kosts.show', $kost->slug) }} class="inline-block bg-kostgo-orange hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $kosts->links() }} {{-- Menampilkan link paginasi --}}
        </div>
    @endif
</div>
@endsection