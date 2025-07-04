@extends('layouts.app')

@section('title', 'Sewa Kos di KostGo - Daftarkan Propertimu')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-kostgo-blue mb-6">Sewa Kos di KostGo</h1>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
            Apakah Anda pemilik kos dan ingin properti Anda lebih mudah ditemukan oleh ribuan calon penyewa setiap harinya? Daftarkan kos Anda di KostGo dan nikmati kemudahan serta keuntungan yang kami tawarkan.
        </p>
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
            KostGo adalah platform terdepan yang menghubungkan Anda dengan calon penghuni kos yang tepat. Dengan jangkauan luas dan fitur promosi yang efektif, kos Anda akan selalu penuh!
        </p>
    </div>

    <h2 class="text-3xl font-bold text-kostgo-blue mb-4">Keuntungan Menjadi Mitra KostGo</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-kostgo-dark-gray mb-2 flex items-center"><i class="fas fa-bullhorn mr-3 text-kostgo-orange"></i>Jangkauan Luas</h3>
            <p class="text-gray-700">Properti Anda akan dilihat oleh ribuan calon penyewa setiap hari.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-kostgo-dark-gray mb-2 flex items-center"><i class="fas fa-chart-line mr-3 text-kostgo-orange"></i>Peningkatan Okupansi</h3>
            <p class="text-gray-700">Optimalkan tingkat hunian kos Anda dengan cepat dan efisien.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-kostgo-dark-gray mb-2 flex items-center"><i class="fas fa-tools mr-3 text-kostgo-orange"></i>Manajemen Mudah</h3>
            <p class="text-gray-700">Kelola informasi kos dan data penyewa dengan fitur dashboard yang intuitif.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-kostgo-dark-gray mb-2 flex items-center"><i class="fas fa-headset mr-3 text-kostgo-orange"></i>Dukungan Pelanggan</h3>
            <p class="text-gray-700">Tim kami siap membantu Anda kapan saja.</p>
        </div>
    </div>

    <h2 class="text-3xl font-bold text-kostgo-blue mb-4">Bagaimana Cara Mendaftar?</h2>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <ol class="list-decimal list-inside space-y-3 text-gray-700 leading-relaxed text-lg">
            <li><span class="font-semibold">Buat Akun:</span> Daftarkan diri Anda sebagai pemilik kos di KostGo.</li>
            <li><span class="font-semibold">Lengkapi Data Kos:</span> Masukkan informasi lengkap tentang properti kos Anda, termasuk foto, fasilitas, harga, dan lokasi.</li>
            <li><span class="font-semibold">Verifikasi:</span> Tim kami akan melakukan verifikasi data kos Anda untuk memastikan akurasi.</li>
            <li><span class="font-semibold">Siap Disewakan!:</span> Setelah diverifikasi, kos Anda akan segera tampil di aplikasi dan website KostGo, siap ditemukan oleh calon penyewa.</li>
        </ol>
        <p class="text-lg text-gray-700 leading-relaxed mt-6">
            Tertarik untuk bergabung? Mari mulai daftarkan kos Anda sekarang juga!
        </p>
        <a href="{{ route('register') }}" class="inline-block bg-kostgo-orange hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 mt-4">
            Daftar Sebagai Pemilik Kos
        </a>
    </div>
</div>
@endsection