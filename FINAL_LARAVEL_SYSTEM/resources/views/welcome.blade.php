<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bloomery Flower Shop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pink-50 text-gray-900">
    <div class="min-h-screen">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6">
            <a href="/" class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-pink-600 text-2xl text-white shadow-lg shadow-pink-200">
                    ❀
                </div>
                <div>
                    <p class="text-xl font-extrabold text-pink-700">Bloomery</p>
                    <p class="text-xs font-medium text-pink-400">Flower Shop</p>
                </div>
            </a>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-full bg-pink-600 px-5 py-2 text-sm font-semibold text-white hover:bg-pink-700">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="rounded-full px-5 py-2 text-sm font-semibold text-pink-700 hover:bg-pink-100">
                        Log in
                    </a>

                    <a href="{{ route('register') }}" class="rounded-full bg-pink-600 px-5 py-2 text-sm font-semibold text-white hover:bg-pink-700">
                        Register
                    </a>
                @endauth
            </div>
        </nav>

        <main class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-10 px-6 py-12 lg:grid-cols-2">
            <section>
                <p class="mb-3 text-sm font-bold uppercase tracking-[0.3em] text-pink-500">
                    Fresh flowers in pesos
                </p>

                <h1 class="text-5xl font-black leading-tight text-gray-900 md:text-6xl">
                    Bloomery Flower Shop
                </h1>

                <p class="mt-5 max-w-xl text-lg leading-8 text-gray-600">
                    Order beautiful bouquets, roses, tulips, orchids, and floral gifts.
                    Customers can add flowers to cart, edit orders, delete items, and pay through GCash, Cash, or Cash on Delivery.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="rounded-full bg-pink-600 px-7 py-3 text-sm font-bold text-white shadow-lg shadow-pink-200 hover:bg-pink-700">
                        Start Shopping
                    </a>

                    <a href="{{ route('login') }}" class="rounded-full border border-pink-200 bg-white px-7 py-3 text-sm font-bold text-pink-700 hover:bg-pink-50">
                        I already have an account
                    </a>
                </div>

                <div class="mt-10 grid grid-cols-3 gap-4 max-w-lg">
                    <div class="rounded-2xl bg-white p-4 shadow-sm">
                        <p class="text-2xl font-black text-pink-600">₱</p>
                        <p class="text-xs text-gray-500">Peso Pricing</p>
                    </div>
                    <div class="rounded-2xl bg-white p-4 shadow-sm">
                        <p class="text-2xl font-black text-pink-600">GCash</p>
                        <p class="text-xs text-gray-500">Payment</p>
                    </div>
                    <div class="rounded-2xl bg-white p-4 shadow-sm">
                        <p class="text-2xl font-black text-pink-600">COD</p>
                        <p class="text-xs text-gray-500">Delivery</p>
                    </div>
                </div>
            </section>

            <section class="relative">
                <div class="absolute -left-6 -top-6 h-32 w-32 rounded-full bg-pink-200 blur-3xl"></div>
                <div class="absolute -bottom-6 -right-6 h-32 w-32 rounded-full bg-rose-200 blur-3xl"></div>

                <div class="relative overflow-hidden rounded-[2rem] bg-white shadow-2xl shadow-pink-100">
                    <img
                        src="https://images.pexels.com/photos/931177/pexels-photo-931177.jpeg?auto=compress&cs=tinysrgb&w=1400"
                        alt="Bloomery flowers"
                        class="h-[520px] w-full object-cover"
                    >
                    <div class="absolute bottom-5 left-5 right-5 rounded-3xl bg-white/90 p-5 backdrop-blur">
                        <p class="text-sm font-bold text-pink-700">Popular today</p>
                        <p class="mt-1 text-2xl font-black text-gray-900">Pink Rose Bouquet</p>
                        <p class="mt-1 text-gray-600">Fresh and elegant bouquet for only <span class="font-bold text-pink-600">₱899.00</span></p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>