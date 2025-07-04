<footer class="bg-kostgo-dark-gray text-white py-8 px-4">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        {{-- Kolom 1: Logo & Deskripsi --}}
        <div>
            <h3 class="text-2xl font-bold text-white mb-4">KostGo</h3>
            <p class="text-kostgo-gray text-sm">Platform pencarian kos terbaik untuk mahasiswa dan pekerja di seluruh Indonesia.</p>
            <div class="flex space-x-4 mt-4">
                <a href="#" class="text-kostgo-gray hover:text-white text-2xl transition duration-200"><i class="fab fa-facebook-square"></i></a>
                <a href="#" class="text-kostgo-gray hover:text-white text-2xl transition duration-200"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-kostgo-gray hover:text-white text-2xl transition duration-200"><i class="fab fa-twitter-square"></i></a>
                <a href="#" class="text-kostgo-gray hover:text-white text-2xl"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        {{-- Kolom 2: Link Cepat --}}
        <div>
            <h3 class="text-xl font-semibold text-white mb-4">Link Cepat</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('search') }}" class="text-kostgo-gray hover:text-white transition duration-200">Cari Kos</a></li>
                <li><a href="{{ route('rent-kost') }}" class="text-kostgo-gray hover:text-white transition duration-200">Sewa Kos</a></li>
                <li><a href="#" class="text-kostgo-gray hover:text-white transition duration-200">Pusat Bantuan</a></li>
                <li><a href="#" class="text-kostgo-gray hover:text-white transition duration-200">Tentang Kami</a></li>
                <li><a href="#" class="text-kostgo-gray hover:text-white transition duration-200">Karir</a></li>
            </ul>
        </div>

        {{-- Kolom 3: Kebijakan & Ketentuan --}}
        <div>
            <h3 class="text-xl font-semibold text-white mb-4">Kebijakan</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="text-kostgo-gray hover:text-white transition duration-200">Kebijakan Privasi</a></li>
                <li><a href="#" class="text-kostgo-gray hover:text-white transition duration-200">Syarat & Ketentuan</a></li>
                <li><a href="{{ route('help-center') }}" class="text-kostgo-gray hover:text-white transition duration-200">FAQ</a></li>
                <li><a href="#" class="text-kostgo-gray hover:text-white transition duration-200">Peta Situs</a></li>
            </ul>
        </div>

        {{-- Kolom 4: Download Aplikasi --}}
        <div>
            <h3 class="text-xl font-semibold text-white mb-4">Download Aplikasi</h3>
            <div class="flex flex-col space-y-3">
                <a href="#" target="_blank" class="block">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/1280px-Google_Play_Store_badge_EN.svg.png" alt="Google Play" class="h-10 w-auto">
                </a>
                <a href="#" target="_blank" class="block">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Download_on_the_App_Store_Badge.svg/1280px-Download_on_the_App_Store_Badge.svg.png" alt="App Store" class="h-10 w-auto">
                </a>
            </div>
        </div>
    </div>

    <div class="text-center text-kostgo-gray text-sm mt-8 border-t border-gray-700 pt-4">
        &copy; {{ date('Y') }} KostGo. Hak Cipta Dilindungi Undang-Undang.
    </div>
</footer>