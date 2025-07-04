<nav class="bg-white shadow-md p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('storage/logo.png') }}" alt="Logo KostGo" class="h-8 md:h-10">
            <span class="text-2xl font-bold text-kostgo-blue">KostGo</span>
        </a>

        {{-- Navigasi Desktop --}}
        <div class="hidden md:flex space-x-6 items-center">
            <a href="{{ route('search') }}" class="text-gray-700 hover:text-kostgo-blue font-medium transition duration-200">Cari Kos</a>
            <a href="{{ route('about') }}" class="text-gray-700 hover:text-kostgo-blue font-medium transition duration-200">Tentang Kami</a>
            <a href="{{ route('help-center') }}" class="text-gray-700 hover:text-kostgo-blue font-medium transition duration-200">Pusat Bantuan</a>
            <a href="{{ route('rent-kost') }}" class="text-gray-700 hover:text-kostgo-blue font-medium transition duration-200">Sewa Kos</a>
        </div>

        {{-- Autentikasi dan Promosikan Iklan --}}
        <div class="flex items-center space-x-4">
            <a href="#" class="hidden md:block text-kostgo-orange hover:text-orange-700 font-medium transition duration-200">Promosikan Iklan Anda</a>
            @auth {{-- Jika pengguna sudah login --}}
                <a href="{{ route('dashboard') }}" class="text-kostgo-blue hover:underline hidden md:block">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg text-sm transition duration-200 hidden md:block">Logout</button>
                </form>
            @else {{-- Jika pengguna belum login --}}
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-kostgo-blue font-medium hidden md:block">Masuk</a>
                <a href="{{ route('register') }}" class="bg-kostgo-blue hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm transition duration-200 hidden md:block">Daftar</a>
            @endauth
        </div>

        {{-- Tombol Hamburger untuk Mobile (dengan Alpine.js) --}}
        <button @click="open = ! open" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-kostgo-blue">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Mobile Menu (dengan Alpine.js) --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden mt-2 border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('search') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-kostgo-blue hover:bg-gray-50">Cari Kos</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-kostgo-blue hover:bg-gray-50">Tentang Kami</a>
            <a href="{{ route('help-center') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-kostgo-blue hover:bg-gray-50">Pusat Bantuan</a>
            {{-- BARIS INI YANG DIKOREKSI --}}
            <a href="{{ route('rent-kost') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-kostgo-blue hover:bg-gray-50">Sewa Kos</a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            <a href="#" class="block px-4 py-2 text-base font-medium text-kostgo-orange hover:bg-gray-100">Promosikan Iklan Anda</a>
            @auth
                <div class="px-4 mt-2">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Masuk</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-kostgo-blue hover:bg-kostgo-light-blue">Daftar</a>
            @endauth
        </div>
    </div>
</nav>