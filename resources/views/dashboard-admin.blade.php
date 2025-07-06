@extends('layouts.app')

@section('title', 'KostGo - Admin Dashboard Pengelola Kos')

@section('content')

<div class="min-h-screen bg-gray-100 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-extrabold text-kostgo-dark-gray mb-8">
            Dashboard Pengelola Kos
        </h1>

        {{-- Ringkasan Statistik --}}
        {{-- Data ini diharapkan diteruskan dari controller, contoh: compact('totalKosts', 'totalRooms', 'availableRooms', 'pendingBookings') --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Card Total Kos --}}
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between transform hover:scale-105 transition duration-300">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Kos Dikelola</p>
                    <p class="text-3xl font-bold text-kostgo-blue mt-1">{{ number_format($totalKosts ?? 0, 0, ',', '.') }}</p> {{-- Menggunakan data dari controller --}}
                </div>
                <i class="fas fa-building text-4xl text-kostgo-blue opacity-20"></i>
            </div>

            {{-- Card Total Kamar --}}
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between transform hover:scale-105 transition duration-300">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Kamar</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ number_format($totalRooms ?? 0, 0, ',', '.') }}</p> {{-- Menggunakan data dari controller --}}
                </div>
                <i class="fas fa-door-open text-4xl text-green-600 opacity-20"></i>
            </div>

            {{-- Card Kamar Tersedia --}}
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between transform hover:scale-105 transition duration-300">
                <div>
                    <p class="text-sm font-medium text-gray-500">Kamar Tersedia</p>
                    <p class="text-3xl font-bold text-orange-500 mt-1">{{ number_format($availableRooms ?? 0, 0, ',', '.') }}</p> {{-- Menggunakan data dari controller --}}
                </div>
                <i class="fas fa-check-circle text-4xl text-orange-500 opacity-20"></i>
            </div>

            {{-- Card Booking Pending --}}
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between transform hover:scale-105 transition duration-300">
                <div>
                    <p class="text-sm font-medium text-gray-500">Booking Pending</p>
                    <p class="text-3xl font-bold text-red-500 mt-1">{{ number_format($pendingBookings ?? 0, 0, ',', '.') }}</p> {{-- Menggunakan data dari controller --}}
                </div>
                <i class="fas fa-hourglass-half text-4xl text-red-500 opacity-20"></i>
            </div>
        </div>

        {{-- Bagian Manajemen Kos --}}
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-kostgo-dark-gray">Kos yang Anda Kelola</h2>
                <a href="{{ route('kosts.create') }}" class="bg-kostgo-orange hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105 shadow-md flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Kos Baru
                </a>
            </div>

            {{-- Tabel Daftar Kos --}}
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        {{-- $myKosts diharapkan diteruskan dari controller --}}
                        @forelse($myKosts as $kost)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kost->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kost->city }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp{{ number_format($kost->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($kost->type) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('kosts.edit', $kost->slug) }}" class="text-kostgo-blue hover:text-blue-900 mr-3">Edit</a>
                                    {{-- Asumsi ada relasi kamar atau halaman terpisah untuk mengelola kamar --}}
                                    <a href="{{ route('kosts.rooms', $kost->slug) }}" class="text-green-600 hover:text-green-900 mr-3">Kamar</a>
                                    <form action="{{ route('kosts.destroy', $kost->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus kos ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Anda belum menambahkan kos apapun.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Bagian Booking Terbaru (Opsional) --}}
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-kostgo-dark-gray mb-6">Booking Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penyewa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Booking</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        {{-- Dummy data untuk booking terbaru, Anda bisa mengganti ini dengan data dari database --}}
                        @php
                            $recentBookings = [
                                (object)['id' => 1, 'tenant_name' => 'Budi Santoso', 'kost_name' => 'Kos Melati Indah', 'room_number' => 'A1', 'booking_date' => '2025-07-01', 'status' => 'Pending'],
                                (object)['id' => 2, 'tenant_name' => 'Siti Aminah', 'kost_name' => 'Kos Anggrek Residence', 'room_number' => 'B3', 'booking_date' => '2025-06-28', 'status' => 'Confirmed'],
                                (object)['id' => 3, 'tenant_name' => 'Joko Susilo', 'kost_name' => 'Kos Mawar Jaya', 'room_number' => 'C2', 'booking_date' => '2025-06-25', 'status' => 'Completed'],
                            ];
                        @endphp

                        @forelse($recentBookings as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->tenant_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->kost_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->room_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->booking_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($booking->status == 'Pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $booking->status }}</span>
                                    @elseif($booking->status == 'Confirmed')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $booking->status }}</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $booking->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('kost.booking', $booking->id) }}" class="text-kostgo-blue hover:text-blue-900 mr-3">Detail</a>
                                    <button class="text-green-600 hover:text-green-900 mr-3">Konfirmasi</button>
                                    <button class="text-red-600 hover:text-red-900">Batal</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Tidak ada booking terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
