@extends('layouts.app')

@section('title', 'Semua Promo Kost - KostGo')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-kostgo-blue mb-6">Semua Promo Kost</h1>

    @if($promos->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md" role="alert">
            <p class="font-bold">Maaf!</p>
            <p>Saat ini belum ada promo kost yang tersedia. Tetap pantau halaman ini ya!</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($promos as $kost)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-200">
                    @php
                        $images = json_decode($kost->images, true);
                        $firstImage = (!empty($images) && is_array($images) && isset($images[0])) ? asset('storage/' . $images[0]) : 'https://via.placeholder.com/400x300?text=Promo+Kos';
                    @endphp
                    <img src="{{ $firstImage }}" alt="{{ $kost->name }}" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h2 class="text-xl font-semibold text-kostgo-dark-gray mb-2">{{ $kost->name }}</h2>
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-map-marker-alt mr-1 text-kostgo-blue"></i> {{ $kost->city }}</p>
                        <p class="text-green-600 text-lg font-bold mb-2">Diskon hingga Rp100.000!</p> {{-- Placeholder promo --}}
                        <div class="text-2xl font-bold text-green-600 mb-4">Rp{{ number_format($kost->price - 100000, 0, ',', '.') }} <span class="text-base font-normal text-gray-500 line-through">Rp{{ number_format($kost->price, 0, ',', '.') }}</span></div>
                        <a href="#" class="inline-block bg-kostgo-orange hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                            Lihat Detail Promo
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $promos->links() }} {{-- Menampilkan link paginasi --}}
        </div>
    @endif
</div>
@endsection