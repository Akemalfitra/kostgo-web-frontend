@extends('layouts.app')

@section('title', 'KostGo - Temukan Kos Impianmu')

@section('content')

{{-- Bagian Hero Section --}}
<div class="relative min-h-[500px] flex items-center justify-center p-4 bg-cover bg-center" style="background-image: url('{{ asset('storage/images/hero-bg.jpg') }}');">
    {{-- Overlay untuk membuat teks lebih terbaca --}}
    <div class="absolute inset-0 bg-black opacity-50 z-0"></div>

    <div class="text-center max-w-3xl mx-auto z-10 relative">
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4 text-white"> {{-- Tambahkan text-white --}}
            Temukan Kos Impianmu di KostGo
        </h1>
        <p class="text-lg md:text-xl mb-8 opacity-90 text-white"> {{-- Tambahkan text-white --}}
            Cari kos dengan mudah, fasilitas lengkap, dan lokasi strategis di seluruh Indonesia.
        </p>

        {{-- Form Pencarian --}}
        <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row gap-4 p-2 bg-white rounded-xl shadow-xl">
            <div class="flex-grow">
                <input type="text" name="lokasi" placeholder="Cari lokasi (contoh: Jakarta, Bandung, Lhokseumawe)"
                       class="w-full p-4 text-kostgo-dark-gray rounded-lg md:rounded-l-lg md:rounded-r-none border border-gray-300 focus:outline-none focus:ring-2 focus:ring-kostgo-blue placeholder-gray-400">
            </div>
            <button type="submit"
                    class="bg-kostgo-orange hover:bg-orange-600 text-white font-bold py-3 md:py-4 px-8 rounded-lg md:rounded-r-lg md:rounded-l-none transition duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center">
                <i class="fas fa-search mr-2"></i> Cari Sekarang
            </button>
        </form>
        <p class="mt-4 text-white text-sm opacity-80">Contoh kota populer: Yogyakarta, Surabaya, Malang, Medan, Aceh</p>
    </div>
</div>


{{-- Bagian Banner Promosi --}}
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-blue-100 rounded-lg p-4 flex items-center justify-between shadow-sm">
            <div>
                <h3 class="text-lg font-semibold text-blue-800 mb-1">Promo Spesial Hari Ini!</h3>
                <p class="text-sm text-blue-600">Diskon hingga Rp150.000 untuk sewa kos tertentu.</p>
            </div>
            {{-- Menggunakan gambar dari storage/banners --}}
            <img src="{{ asset('storage/banners/promo_1.png') }}" alt="Promo Banner" class="rounded-md w-24 h-20 object-cover">
        </div>
        <div class="bg-green-100 rounded-lg p-4 flex items-center justify-between shadow-sm">
            <div>
                <h3 class="text-lg font-semibold text-green-800 mb-1">Dapatkan Cashback</h3>
                <p class="text-sm text-green-600">Nikmati cashback eksklusif untuk pengguna baru.</p>
            </div>
            {{-- Menggunakan gambar dari storage/banners --}}
            <img src="{{ asset('storage/banners/promo_2.png') }}" alt="Cashback Banner" class="rounded-md w-24 h-20 object-cover">
        </div>
        <div class="bg-purple-100 rounded-lg p-4 flex items-center justify-between shadow-sm">
            <div>
                <h3 class="text-lg font-semibold text-purple-800 mb-1">Undang Teman & Dapatkan Hadiah</h3>
                <p class="text-sm text-purple-600">Ajak temanmu bergabung dengan KostGo!</p>
            </div>
            {{-- Menggunakan gambar dari storage/banners --}}
            <img src="{{ asset('storage/banners/promo_3.png') }}" alt="Invite Friends Banner" class="rounded-md w-24 h-20 object-cover">
        </div>
    </div>
</div>
{{-- Bagian Lihat Juga Promo Kos (Horizontal Scroll) --}}
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl md:text-3xl font-bold text-kostgo-dark-gray mb-6 flex justify-between items-center">
        Lihat Juga Promo Kos
        <a href="{{ route('promos.index') }}" class="text-kostgo-blue text-base font-semibold hover:underline">Lihat Semua Promo</a>
    </h2>
    <div class="flex overflow-x-auto scrollbar-hide space-x-4 pb-4">
        @php
            // Ambil beberapa kos secara acak dari database untuk dijadikan contoh promo
            // Anda bisa menyesuaikan jumlahnya (misal limit(6))
            $promoKosts = App\Models\Kosts::inRandomOrder()->limit(6)->get();
        @endphp

        @forelse($promoKosts as $kost)
            <div class="flex-shrink-0 w-64 bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-200">
                @php
                    $images = $kost->image;
                    $firstImage = (!empty($images) && is_array($images) && isset($images[0])) ? asset('storage/' . $images[0]) : 'https://via.placeholder.com/256x160?text=Kos+Promo';
                    $originalPrice = $kost->price;
                    $discountAmount = 100000;
                    $promoPrice = $originalPrice - $discountAmount;
                    if ($promoPrice < 0) $promoPrice = 0;
                @endphp
                <img src="{{ $firstImage }}" alt="{{ $kost->name }}" class="w-full h-40 object-cover">
                <div class="p-3">
                    <h3 class="text-lg font-semibold text-kostgo-dark-gray mb-1">{{ $kost->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $kost->city }}</p>
                    <p class="text-sm text-green-600 font-bold mb-2">Diskon hingga Rp{{ number_format($discountAmount, 0, ',', '.') }}!</p>
                    <div class="flex justify-between items-center text-sm">
                        <div>
                            <span class="text-gray-500 line-through mr-2">Rp{{ number_format($originalPrice, 0, ',', '.') }}</span>
                            <span class="text-green-600 font-bold text-lg">Rp{{ number_format($promoPrice, 0, ',', '.') }}</span>
                        </div>
                       
                        <a href="{{ route('kosts.show', $kost->slug) }}" class="text-kostgo-blue hover:underline">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            {{-- Pesan jika tidak ada kos yang ditemukan untuk promo --}}
            <div class="flex-shrink-0 w-full bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md">
                <p>Saat ini belum ada kos yang sedang dalam promo.</p>
            </div>
        @endforelse
    </div>
</div>
{{-- Bagian Kost Populer di Sekitar (Grid Kos) --}}
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl md:text-3xl font-bold text-kostgo-dark-gray mb-6 flex justify-between items-center">
        Kost Populer di Sekitar
        <a href="{{ route('search') }}" class="text-kostgo-blue text-base font-semibold hover:underline">Lihat Semua Kos</a>
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            // Ambil 4 kos terpopuler atau terbaru untuk ditampilkan di homepage
            // Anda mungkin perlu memodifikasi HomeController@index untuk mengambil data ini
            // Untuk demo, kita pakai data dummy
            $popularKosts = App\Models\Kosts::inRandomOrder()->limit(4)->get(); // Mengambil 4 kos acak
        @endphp

        @forelse($popularKosts as $kost)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-200">
                @php
                    $images = $kost->image;
                    $firstImage = (!empty($images) && is_array($images) && isset($images[0])) ? asset('storage/' . $images[0]) : 'https://via.placeholder.com/400x300?text=No+Image';
                @endphp
                <img src="{{ $firstImage }}" alt="{{ $kost->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-kostgo-dark-gray mb-1">{{ $kost->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $kost->address }}, {{ $kost->city }}</p>
                    <div class="text-xl font-bold text-green-600 mb-3">Rp{{ number_format($kost->price, 0, ',', '.') }}</div>
                    <a href={{ route('kosts.show', $kost->slug) }} class="inline-block bg-kostgo-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition duration-300">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md">
                <p>Belum ada kost populer yang tersedia.</p>
            </div>
        @endforelse
    </div>
</div>

{{-- Bagian Cari Kost Berdasarkan Area Terpopuler (Grid Kota/Area) --}}
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl md:text-3xl font-bold text-kostgo-dark-gray mb-6 flex justify-between items-center">
        Cari Kost Berdasarkan Area Terpopuler
        <a href="#" class="text-kostgo-blue text-base font-semibold hover:underline">Lihat Semua Area</a>
    </h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
        @php
            $topAreas = [
                ['name' => 'Lhokseumawe', 'image' => 'locations/lhokseumawe.png'],
                ['name' => 'Banda Aceh', 'image' => 'locations/bandaaceh.png'],
                ['name' => 'Bandung', 'image' => 'locations/bandung.png'],
                ['name' => 'Jakarta', 'image' => 'locations/jakarta.png'],
                ['name' => 'Surabaya', 'image' => 'locations/surabaya.png'],
                ['name' => 'Yogyakarta', 'image' => 'locations/yogyakarta.png'],
                ['name' => 'Medan', 'image' => 'locations/medan.png'],
                ['name' => 'Makassar', 'image' => 'locations/makasar.png'],
            ];
            // Pastikan Anda menempatkan gambar ini di storage/app/public/locations/
        @endphp
        @foreach($topAreas as $area)
            <a href="{{ route('search', ['lokasi' => $area['name']]) }}" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                <img src="{{ asset('storage/' . $area['image']) }}" alt="Area {{ $area['name'] }}" class="w-full h-32 object-cover">
                <div class="p-3 text-center">
                    <h3 class="text-md font-semibold text-kostgo-dark-gray">{{ $area['name'] }}</h3>
                </div>
            </a>
        @endforeach
    </div>
</div>

@endsection