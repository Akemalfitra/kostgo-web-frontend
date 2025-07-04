<x-guest-layout>
    <div class="px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-kostgo-blue">Daftar Akun Baru</h2>
            <p class="text-gray-600 text-sm">Buat akun KostGo Anda untuk memulai petualangan mencari kos!</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-kostgo-dark-gray" />
                <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-kostgo-blue focus:ring-kostgo-blue rounded-md shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="email" :value="__('Alamat Email')" class="text-kostgo-dark-gray" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-kostgo-blue focus:ring-kostgo-blue rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-kostgo-dark-gray" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-kostgo-blue focus:ring-kostgo-blue rounded-md shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-kostgo-dark-gray" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-kostgo-blue focus:ring-kostgo-blue rounded-md shadow-sm"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-kostgo-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kostgo-blue" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-primary-button class="ms-4 bg-kostgo-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    {{ __('Daftar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>