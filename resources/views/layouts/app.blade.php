<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body class="relative font-sans antialiased min-h-screen flex flex-col justify-center" style="">
    @if (session('error'))
        <div class="bg-gray-800 bg-opacity-80 min-h-screen min-w-full absolute content-center place-items-center">
            <div class="min-w-96 min-h-48 p-4 border border-gray-300 rounded-2xl text-center bg-gray-50">
                <p class="my-4 text-xl font-bold">Error!</p>
                <p class="my-4">{{ session('error') }}</p>
                <a href="/"><x-submit-button text="OK" class="my-4" /></a>
            </div>
        </div>
    @endif

    @if (session('admin_deleted_profile'))
        <div class="bg-gray-800 bg-opacity-80 min-h-screen min-w-full absolute content-center place-items-center">
            <div class="min-w-96 min-h-48 p-4 border border-gray-300 rounded-2xl text-center bg-gray-50">
                <p class="my-4">{{ session('admin_deleted_profile') }}</p>
                <a href="/dashboard"><x-submit-button text="OK" class="my-4" /></a>
            </div>
        </div>
    @else
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="w-full mx-auto">
            {{ $slot }}
        </main>

        <x-footer />
    @endif
</body>

</html>
