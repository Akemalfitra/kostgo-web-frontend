@extends('layouts.app')

@section('title', 'Pusat Bantuan - KostGo')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-kostgo-blue mb-6">Pusat Bantuan KostGo</h1>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
            Selamat datang di Pusat Bantuan KostGo. Kami di sini untuk menjawab pertanyaan Anda dan membantu Anda menggunakan platform kami dengan lebih baik. Silakan pilih kategori di bawah ini atau gunakan kotak pencarian untuk menemukan jawaban yang Anda butuhkan.
        </p>

        {{-- Form Pencarian FAQ --}}
        <form action="#" method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
            <input type="text" name="query" placeholder="Cari pertanyaan atau topik..."
                   class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-kostgo-blue flex-grow">
            <button type="submit"
                    class="bg-kostgo-blue hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Cari
            </button>
        </form>

        <h2 class="text-2xl font-bold text-kostgo-dark-gray mb-4">Pertanyaan Umum (FAQ)</h2>
        <div class="space-y-4">
            {{-- FAQ Item 1 --}}
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button class="w-full text-left p-4 bg-gray-50 hover:bg-gray-100 flex justify-between items-center"
                        onclick="document.getElementById('faq1-content').classList.toggle('hidden');">
                    <span class="font-semibold text-gray-800">Bagaimana cara mencari kos di KostGo?</span>
                    <i class="fas fa-chevron-down text-gray-500"></i>
                </button>
                <div id="faq1-content" class="hidden p-4 text-gray-700 border-t border-gray-200">
                    Anda bisa mencari kos dengan memasukkan lokasi (kota, area, atau alamat) di kolom pencarian di halaman utama. Gunakan juga filter seperti jenis kos, harga, dan fasilitas untuk mempersempit hasil pencarian Anda.
                </div>
            </div>

            {{-- FAQ Item 2 --}}
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button class="w-full text-left p-4 bg-gray-50 hover:bg-gray-100 flex justify-between items-center"
                        onclick="document.getElementById('faq2-content').classList.toggle('hidden');">
                    <span class="font-semibold text-gray-800">Bagaimana cara menghubungi pemilik kos?</span>
                    <i class="fas fa-chevron-down text-gray-500"></i>
                </button>
                <div id="faq2-content" class="hidden p-4 text-gray-700 border-t border-gray-200">
                    Di halaman detail setiap kos, Anda akan menemukan tombol "Hubungi Pemilik". Anda bisa memilih untuk menghubungi melalui telepon atau WhatsApp. Pastikan Anda sudah login untuk mengakses informasi kontak.
                </div>
            </div>

            {{-- FAQ Item 3 --}}
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button class="w-full text-left p-4 bg-gray-50 hover:bg-gray-100 flex justify-between items-center"
                        onclick="document.getElementById('faq3-content').classList.toggle('hidden');">
                    <span class="font-semibold text-gray-800">Apakah KostGo mengenakan biaya pendaftaran?</span>
                    <i class="fas fa-chevron-down text-gray-500"></i>
                </button>
                <div id="faq3-content" class="hidden p-4 text-gray-700 border-t border-gray-200">
                    Tidak, pendaftaran dan pencarian kos di KostGo sepenuhnya gratis bagi calon penyewa.
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-3xl font-bold text-kostgo-blue mb-4">Tidak Menemukan Jawaban?</h2>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <p class="text-gray-700 leading-relaxed mb-4">
            Jika Anda tidak menemukan jawaban atas pertanyaan Anda di FAQ, jangan ragu untuk menghubungi tim dukungan pelanggan kami.
        </p>
        <a href="#" class="inline-block bg-kostgo-orange hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
            Kirim Pesan ke Kami
        </a>
        <p class="text-gray-700 leading-relaxed mt-4">
            Atau hubungi kami melalui telepon: <span class="font-semibold text-kostgo-blue">+62 812-345-6789</span>
        </p>
    </div>
</div>
@endsection