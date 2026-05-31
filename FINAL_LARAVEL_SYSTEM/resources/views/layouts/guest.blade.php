<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bloomery Flower Shop</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen bg-gradient-to-br from-pink-50 via-white to-rose-100 flex flex-col items-center justify-center px-4 py-8">
            <div>
                <a href="/">
                    <x-application-logo />
                </a>
            </div>

            <div class="mt-6 w-full sm:max-w-md overflow-hidden rounded-3xl bg-white px-8 py-7 shadow-xl shadow-pink-100 border border-pink-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>