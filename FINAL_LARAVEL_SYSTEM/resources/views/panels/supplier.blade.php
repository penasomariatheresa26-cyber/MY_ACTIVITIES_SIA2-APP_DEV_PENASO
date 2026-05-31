<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            Supplier Panel
        </h2>
    </x-slot>

    <div class="min-h-screen bg-pink-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-white p-8 shadow-sm border border-pink-100">
                <h1 class="text-2xl font-bold text-pink-700">
                    Welcome, {{ auth()->user()->name }}
                </h1>

                <p class="mt-2 text-gray-600">
                    You are logged in as supplier.
                </p>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-pink-100 p-5">
                        <p class="text-sm text-gray-500">Role</p>
                        <p class="text-xl font-bold text-pink-600">Supplier</p>
                    </div>

                    <div class="rounded-2xl border border-pink-100 p-5">
                        <p class="text-sm text-gray-500">Products Supplied</p>
                        <p class="text-xl font-bold text-pink-600">Flowers</p>
                    </div>

                    <div class="rounded-2xl border border-pink-100 p-5">
                        <p class="text-sm text-gray-500">Currency</p>
                        <p class="text-xl font-bold text-pink-600">Peso ₱</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>