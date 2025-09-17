<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="pokemon">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Pokémon Collection</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-primary">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-6">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div class="text-6xl mb-4">⚡</div>
                <h1 class="text-4xl font-bold text-white mb-2">Pokémon Collection</h1>
                <p class="text-white/80">Gerencie sua coleção de Pokémon GO</p>
            </div>

            <!-- Card Container -->
            <div class="w-full sm:max-w-md">
                <div class="card bg-base-100 shadow-2xl">
                    <div class="card-body">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-white/60 text-sm">
                <p>&copy; {{ date('Y') }} Pokémon Collection Manager</p>
            </div>
        </div>
    </body>
</html>
