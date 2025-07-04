<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'KostGo - Cari Kos Impianmu')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- Tambahkan x-data="{ open: false }" untuk fungsionalitas menu mobile Alpine.js --}}
<body class="font-sans antialiased" x-data="{ open: false }">
    <div class="min-h-screen bg-gray-100 flex flex-col">
        {{-- Sertakan Header --}}
        @include('partials.header')

        <main class="flex-grow"> {{-- Memastikan main mengisi ruang tersisa --}}
            @yield('content')
        </main>

        {{-- Sertakan Footer --}}
        @include('partials.footer')
    </div>
</body>
</html>