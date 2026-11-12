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
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-slate-50 px-4 py-10 sm:px-6">
            <div class="mb-6 text-center">
                <a href="/">
                    <x-application-logo class="mx-auto h-14 w-14 fill-current text-blue-700" />
                </a>
                <p class="mt-3 text-sm font-bold tracking-wide text-slate-900">INVENTARIS POLNEP</p>
                <p class="mt-1 text-xs text-slate-500">Sistem Informasi Inventaris Aset</p>
            </div>

            <div class="w-full max-w-md overflow-hidden rounded-2xl border border-slate-200 bg-white px-6 py-7 shadow-sm sm:px-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
