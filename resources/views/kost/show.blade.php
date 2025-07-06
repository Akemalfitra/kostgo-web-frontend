@extends('layouts.app')

@section('title', 'KostGo - Detail Kos ' . $kost->name)

@section('content')

<div class="min-h-screen bg-gray-100 p-4 sm:p-6 lg:p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">

        {{-- Tampilan Gambar Tunggal --}}
        <div class="relative">
            @php
             $images = is_array($kost->image) ? $kost->image : json_decode($kost->image, true);
            @endphp
            @if (!empty($images) && is_array($images) && count($images) > 0)
            <img src="{{ asset('storage/' . $images[0]) }}" alt="Gambar Kos {{ $kost->name }}" class="w-full h-96 object-cover bg-gray-200">
            @else
            <img src="https://placehold.co/1200x400/E0E0E0/808080?text=Tidak+Ada+Gambar" alt="Tidak Ada Gambar" class="w-full h-96 object-cover bg-gray-200">
            @endif
        </div>
        {{-- Informasi Kos --}}

        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-kostgo-dark-gray mb-2">{{ $kost->name }}</h1>
                    {{-- Menggunakan $kost->price --}}
                    <p class="text-xl font-bold text-green-600 mb-2">Rp{{ number_format($kost->price, 0, ',', '.') }} <span class="text-gray-500 text-base font-normal">/ bulan</span></p>
                    <p class="text-gray-600 text-lg"><i class="fas fa-map-marker-alt mr-2 text-kostgo-blue"></i>{{ $kost->address }}, {{ $kost->city }}</p>
                </div>
                <div class="mt-4 md:mt-0 flex flex-col items-center md:items-end">
                    @if($kost->owner_whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kost->owner_whatsapp) }}" target="_blank"
                           class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300 transform hover:scale-105 shadow-md flex items-center mb-3">
                            <i class="fab fa-whatsapp mr-2"></i> Hubungi via WhatsApp
                        </a>
                    @elseif($kost->owner_phone)
                        <a href="tel:{{ $kost->owner_phone }}"
                           class="bg-kostgo-blue hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300 transform hover:scale-105 shadow-md flex items-center mb-3">
                            <i class="fas fa-phone mr-2"></i> Hubungi via Telepon
                        </a>
                    @endif
                    @if($kost->latitude && $kost->longitude)
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $kost->latitude }},{{ $kost->longitude }}" target="_blank"
                           class="text-kostgo-blue hover:underline text-sm flex items-center">
                            <i class="fas fa-map mr-2"></i> Lihat Lokasi di Peta
                        </a>
                    @endif
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-kostgo-dark-gray mb-3">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $kost->description ?: 'Tidak ada deskripsi tersedia untuk kos ini.' }}
                </p>
            </div>

            {{-- Detail Kos --}}
            <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-2xl font-bold text-kostgo-dark-gray mb-3">Detail Kos</h2>
                    <ul class="space-y-2 text-gray-700">
                        <li><strong class="font-semibold">Tipe Kos:</strong> {{ ucfirst($kost->type) }}</li>
                        <li><strong class="font-semibold">Alamat:</strong> {{ $kost->address }}</li>
                        <li><strong class="font-semibold">Kota:</strong> {{ $kost->city }}</li>
                        @if($kost->owner_phone)
                            <li><strong class="font-semibold">Telepon Pemilik:</strong> {{ $kost->owner_phone }}</li>
                        @endif
                        @if($kost->owner_whatsapp)
                            <li><strong class="font-semibold">WhatsApp Pemilik:</strong> {{ $kost->owner_whatsapp }}</li>
                        @endif
                    </ul>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-kostgo-dark-gray mb-3">Fasilitas</h2>
                    @php
                        $facilitiesArray = json_decode($kost->facilities, true);
                    @endphp
                    @if ($facilitiesArray && count($facilitiesArray) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-gray-700">
                            @foreach ($facilitiesArray as $facility)
                                <div class="flex items-center bg-gray-50 rounded-md p-2 shadow-sm">
                                    <i class="fas fa-check-circle text-green-500 mr-2 text-lg"></i>
                                    <span class="text-sm font-medium">{{ $facility }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">Tidak ada fasilitas yang tercantum.</p>
                    @endif
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <div class="text-center mt-8">
                <a href="{{ url()->previous() }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

        </div>
    </div>
</div>

{{-- Swiper JS dan CSS dihapus karena hanya menampilkan satu gambar --}}

@endsection
