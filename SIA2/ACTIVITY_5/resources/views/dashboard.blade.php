


<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-pink-500">
                💖 Integration Dashboard
            </h2>

            <div class="bg-gradient-to-r from-pink-400 to-purple-400 text-white px-4 py-2 rounded-full shadow-md">
                ✨ {{ Auth::user()->name }}
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-pink-400 via-purple-400 to-pink-300 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Card -->
            <div class="bg-white/90 backdrop-blur-md shadow-2xl rounded-3xl p-8 mb-8 border border-pink-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-4xl font-bold text-pink-500 mb-2">
                            🌸 Welcome, {{ Auth::user()->name }}!
                        </h1>

                        <p class="text-gray-600 text-lg">
                            Your Laravel Integration App is successfully connected with APIs and authentication.
                        </p>
                    </div>

                    <div class="bg-gradient-to-r from-pink-400 to-purple-400 text-white px-6 py-4 rounded-2xl shadow-lg">
                        <p class="font-semibold text-lg">
                            👩 Role: {{ Auth::user()->role }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tabs Section -->
            <div x-data="{ tab: 'overview' }">

                <!-- Tab Buttons -->
                <div class="flex flex-wrap gap-4 mb-6">

                    <button
                        @click="tab='overview'"
                        :class="tab === 'overview' ? 'bg-pink-500 text-white' : 'bg-white text-pink-500'"
                        class="px-6 py-3 rounded-2xl shadow font-semibold transition duration-300"
                    >
                        🌸 Overview
                    </button>

                    <button
                        @click="tab='profile'"
                        :class="tab === 'profile' ? 'bg-purple-500 text-white' : 'bg-white text-purple-500'"
                        class="px-6 py-3 rounded-2xl shadow font-semibold transition duration-300"
                    >
                        👩 Profile
                    </button>

                    <button
                        @click="tab='api'"
                        :class="tab === 'api' ? 'bg-pink-500 text-white' : 'bg-white text-pink-500'"
                        class="px-6 py-3 rounded-2xl shadow font-semibold transition duration-300"
                    >
                        🌐 API Info
                    </button>

                    <button
                        @click="tab='features'"
                        :class="tab === 'features' ? 'bg-purple-500 text-white' : 'bg-white text-purple-500'"
                        class="px-6 py-3 rounded-2xl shadow font-semibold transition duration-300"
                    >
                        ✨ Features
                    </button>

                </div>

                <!-- Overview Tab -->
                <div x-show="tab === 'overview'" x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                        <div class="bg-pink-50/90 backdrop-blur-md p-6 rounded-3xl shadow-lg border border-pink-200 hover:scale-105 transition duration-300">
                            <div class="text-5xl mb-4">🔐</div>
                            <h2 class="text-2xl font-bold text-pink-500 mb-2">
                                Authentication
                            </h2>
                            <p class="text-gray-600">
                                Laravel Breeze manages secure login and registration.
                            </p>
                        </div>

                        <div class="bg-purple-50/90 backdrop-blur-md p-6 rounded-3xl shadow-lg border border-purple-200 hover:scale-105 transition duration-300">
                            <div class="text-5xl mb-4">🌐</div>
                            <h2 class="text-2xl font-bold text-purple-500 mb-2">
                                API Integration
                            </h2>
                            <p class="text-gray-600">
                                Connect and display external API data dynamically.
                            </p>
                        </div>

                        <div class="bg-pink-50/90 backdrop-blur-md p-6 rounded-3xl shadow-lg border border-pink-200 hover:scale-105 transition duration-300">
                            <div class="text-5xl mb-4">💻</div>
                            <h2 class="text-2xl font-bold text-pink-500 mb-2">
                                Dashboard
                            </h2>
                            <p class="text-gray-600">
                                Cute and responsive dashboard with Tailwind CSS.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Profile Tab -->
                <div x-show="tab === 'profile'" x-transition>
                    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl p-8 border border-purple-200 mb-8">
                        <h2 class="text-3xl font-bold text-purple-500 mb-6">
                            👩 User Profile
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="bg-pink-50 p-5 rounded-2xl">
                                <h3 class="font-semibold text-pink-500 mb-1">Full Name</h3>
                                <p class="text-gray-700 text-lg">{{ Auth::user()->name }}</p>
                            </div>

                            <div class="bg-purple-50 p-5 rounded-2xl">
                                <h3 class="font-semibold text-purple-500 mb-1">Email Address</h3>
                                <p class="text-gray-700 text-lg">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="bg-pink-50 p-5 rounded-2xl">
                                <h3 class="font-semibold text-pink-500 mb-1">User Role</h3>
                                <p class="text-gray-700 text-lg">{{ Auth::user()->role }}</p>
                            </div>

                            <div class="bg-purple-50 p-5 rounded-2xl">
                                <h3 class="font-semibold text-purple-500 mb-1">Status</h3>
                                <p class="text-green-500 font-semibold text-lg">Active</p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- API Tab -->
                <div x-show="tab === 'api'" x-transition>
                    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl p-8 border border-pink-200 mb-8">
                        <h2 class="text-3xl font-bold text-pink-500 mb-6">
                            🌐 API Information
                        </h2>

                        <div class="space-y-5">

                            <div class="bg-pink-50 p-5 rounded-2xl">
                                <h3 class="font-semibold text-pink-500 mb-2">
                                    Laravel API Endpoint
                                </h3>

                                <p class="text-gray-700">
                                    http://127.0.0.1:8000/api/users
                                </p>
                            </div>

                            <div class="bg-purple-50 p-5 rounded-2xl">
                                <h3 class="font-semibold text-purple-500 mb-2">
                                    Public API Used
                                </h3>

                                <p class="text-gray-700">
                                    JSONPlaceholder API
                                </p>
                            </div>

                            <div class="bg-pink-50 p-5 rounded-2xl">
                                <h3 class="font-semibold text-pink-500 mb-2">
                                    API Features
                                </h3>

                                <ul class="list-disc list-inside text-gray-700 space-y-1">
                                    <li>Fetch user data</li>
                                    <li>Display external posts</li>
                                    <li>System integration</li>
                                    <li>RESTful API communication</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Features Tab -->
                <div x-show="tab === 'features'" x-transition>
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-purple-100">
                        <h2 class="text-3xl font-bold text-purple-500 mb-6">
                            ✨ System Features
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="bg-gradient-to-r from-pink-100 to-pink-50 p-6 rounded-2xl shadow">
                                <h3 class="text-xl font-bold text-pink-500 mb-2">
                                    🔐 Login & Registration
                                </h3>

                                <p class="text-gray-700">
                                    Secure authentication system using Laravel Breeze.
                                </p>
                            </div>

                            <div class="bg-gradient-to-r from-purple-100 to-purple-50 p-6 rounded-2xl shadow">
                                <h3 class="text-xl font-bold text-purple-500 mb-2">
                                    🌐 API Integration
                                </h3>

                                <p class="text-gray-700">
                                    Displays external API data inside the dashboard.
                                </p>
                            </div>

                            <div class="bg-gradient-to-r from-pink-100 to-pink-50 p-6 rounded-2xl shadow">
                                <h3 class="text-xl font-bold text-pink-500 mb-2">
                                    👩 User Roles
                                </h3>

                                <p class="text-gray-700">
                                    Separate dashboards for Admin and User roles.
                                </p>
                            </div>

                            <div class="bg-gradient-to-r from-purple-100 to-purple-50 p-6 rounded-2xl shadow">
                                <h3 class="text-xl font-bold text-purple-500 mb-2">
                                    🎨 Responsive UI
                                </h3>

                                <p class="text-gray-700">
                                    Modern girly design using Tailwind CSS.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="text-center mt-10 text-pink-400 text-sm font-semibold">
                💖 Laravel Integration App | Made with Pink & Purple Aesthetic ✨
            </div>

        </div>
    </div>
</x-app-layout>
