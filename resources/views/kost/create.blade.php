@extends('layouts.app')

@section('title', 'KostGo - Tambah Kos Baru')

@section('content')

<div class="min-h-screen bg-gray-100 p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-kostgo-dark-gray">Tambah Kos Baru</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-kostgo-blue hover:underline">Kembali ke Dashboard</a>
        </div>

        {{-- Form Tambah Kos --}}
        <form action="{{ route('kosts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Nama Kos --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kos</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                       placeholder="Contoh: Kos Melati Indah" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                          placeholder="Deskripsi lengkap tentang kos, fasilitas, dan keunggulan.">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                       placeholder="Contoh: Jl. Merdeka No. 10" required>
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kota --}}
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                <input type="text" name="city" id="city" value="{{ old('city') }}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                       placeholder="Contoh: Lhokseumawe" required>
                @error('city')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (per bulan)</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                       placeholder="Contoh: 850000" min="0" required>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tipe Kos --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kos</label>
                <select name="type" id="type"
                        class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm" required>
                    <option value="">Pilih Tipe</option>
                    <option value="putra" {{ old('type') == 'putra' ? 'selected' : '' }}>Putra</option>
                    <option value="putri" {{ old('type') == 'putri' ? 'selected' : '' }}>Putri</option>
                    <option value="campur" {{ old('type') == 'campur' ? 'selected' : '' }}>Campur</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Fasilitas (multiple select atau checkbox) --}}
            <div>
                <label for="facilities" class="block text-sm font-medium text-gray-700 mb-1">Fasilitas (pilih beberapa)</label>
                <div class="mt-1 grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $allFacilities = ['AC', 'WiFi', 'Kamar Mandi Dalam', 'Kasur', 'Lemari', 'Meja Belajar', 'Dapur Bersama', 'Parkir Motor', 'Parkir Mobil', 'Keamanan 24 Jam', 'Laundry'];
                        $oldFacilities = old('facilities', []);
                    @endphp
                    @foreach($allFacilities as $facility)
                        <div class="flex items-center">
                            <input type="checkbox" name="facilities[]" id="facility_{{ Str::slug($facility) }}" value="{{ $facility }}"
                                   class="h-4 w-4 text-kostgo-blue border-gray-300 rounded focus:ring-kostgo-blue"
                                   {{ in_array($facility, $oldFacilities) ? 'checked' : '' }}>
                            <label for="facility_{{ Str::slug($facility) }}" class="ml-2 block text-sm text-gray-900">{{ $facility }}</label>
                        </div>
                    @endforeach
                </div>
                @error('facilities')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar Kos --}}
            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Gambar Kos (bisa lebih dari satu)</label>
                <input type="file" name="images[]" id="images" multiple accept="image/*" required
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-kostgo-blue file:text-white hover:file:bg-blue-700">
                @error('images')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                @error('images.*') {{-- Untuk error setiap file gambar --}}
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Latitude & Longitude (Opsional, bisa diisi manual atau pakai peta) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                           class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                           placeholder="Contoh: -6.208763">
                    @error('latitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                           class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                           placeholder="Contoh: 106.845599">
                    @error('longitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Nomor Telepon Pemilik --}}
            <div>
                <label for="owner_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Pemilik</label>
                <input type="text" name="owner_phone" id="owner_phone" value="{{ old('owner_phone') }}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                       placeholder="Contoh: 081234567890">
                @error('owner_phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor WhatsApp Pemilik --}}
            <div>
                <label for="owner_whatsapp" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp Pemilik</label>
                <input type="text" name="owner_whatsapp" id="owner_whatsapp" value="{{ old('owner_whatsapp') }}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                       placeholder="Contoh: 6281234567890 (dengan kode negara)">
                @error('owner_whatsapp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Submit --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-kostgo-orange hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105 shadow-md flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Kos
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
