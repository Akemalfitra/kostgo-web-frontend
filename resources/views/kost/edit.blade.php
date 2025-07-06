@extends('layouts.app')

@section('title', 'KostGo - Edit Kos')

@section('content')

<div class="min-h-screen bg-gray-100 p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-kostgo-dark-gray">Edit Kos: {{ $kost->name }}</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-kostgo-blue hover:underline">Kembali ke Dashboard</a>
        </div>

        <form action="{{ route('kosts.update', $kost->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH') {{-- Ini sudah benar untuk mengirimkan _method=PATCH --}}

            {{-- Nama Kos --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kos</label>
                <input type="text" name="name" id="name" value="{{ old('name', $kost->name) }}"
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
                          placeholder="Deskripsi lengkap tentang kos, fasilitas, dan keunggulan.">{{ old('description', $kost->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <input type="text" name="address" id="address" value="{{ old('address', $kost->address) }}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                       placeholder="Contoh: Jl. Merdeka No. 10" required>
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kota --}}
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                <input type="text" name="city" id="city" value="{{ old('city', $kost->city) }}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                       placeholder="Contoh: Lhokseumawe" required>
                @error('city')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (per bulan)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $kost->price) }}"
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
                    <option value="putra" {{ old('type', $kost->type) == 'putra' ? 'selected' : '' }}>Putra</option>
                    <option value="putri" {{ old('type', $kost->type) == 'putri' ? 'selected' : '' }}>Putri</option>
                    <option value="campur" {{ old('type', $kost->type) == 'campur' ? 'selected' : '' }}>Campur</option>
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
                        // Pastikan $selectedFacilities selalu array
                        $selectedFacilities = (array) old('facilities', $kost->facilities);
                    @endphp
                    @foreach($allFacilities as $facility)
                        <div class="flex items-center">
                            <input type="checkbox" name="facilities[]" id="facility_{{ Str::slug($facility) }}" value="{{ $facility }}"
                                   class="h-4 w-4 text-kostgo-blue border-gray-300 rounded focus:ring-kostgo-blue"
                                   {{ in_array($facility, $selectedFacilities) ? 'checked' : '' }}>
                            <label for="facility_{{ Str::slug($facility) }}" class="ml-2 block text-sm text-gray-900">{{ $facility }}</label>
                        </div>
                    @endforeach
                </div>
                @error('facilities')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar Kos yang Sudah Ada --}}
            @if ($kost->images && count($kost->images) > 0)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($kost->images as $image)
                            <div class="relative group">
                                <img src="{{ asset($image) }}" alt="Kost Image" class="w-full h-32 object-cover rounded-md shadow-sm">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-md">
                                    <label class="flex items-center text-white text-sm cursor-pointer">
                                        <input type="checkbox" name="existing_images[]" value="{{ $image }}" checked
                                               class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mr-2">
                                        <span class="font-semibold">Pertahankan</span>
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 text-center">Uncheck untuk menghapus</p>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Gambar yang tidak dicentang akan dihapus saat disimpan.</p>
                </div>
            @endif

            {{-- Tambah Gambar Baru --}}
            <div class="mt-6">
                <label for="new_images" class="block text-sm font-medium text-gray-700 mb-1">Tambah Gambar Baru</label>
                <input type="file" name="images[]" id="new_images" multiple accept="image/*"
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-kostgo-blue file:text-white hover:file:bg-blue-700">
                @error('images')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Latitude & Longitude --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $kost->latitude) }}"
                           class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                           placeholder="Contoh: -6.208763">
                    @error('latitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $kost->longitude) }}"
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
                <input type="text" name="owner_phone" id="owner_phone" value="{{ old('owner_phone', $kost->owner_phone) }}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-kostgo-blue focus:border-kostgo-blue sm:text-sm"
                       placeholder="Contoh: 081234567890">
                @error('owner_phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor WhatsApp Pemilik --}}
            <div>
                <label for="owner_whatsapp" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp Pemilik</label>
                <input type="text" name="owner_whatsapp" id="owner_whatsapp" value="{{ old('owner_whatsapp', $kost->owner_whatsapp) }}"
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
                    <i class="fas fa-sync-alt mr-2"></i> Perbarui Kos
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
