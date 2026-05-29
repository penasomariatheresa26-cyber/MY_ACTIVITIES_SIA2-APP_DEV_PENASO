<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap');
        body { background: #000 !important; font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(236, 72, 153, 0.2);
            box-shadow: 0 8px 32px 0 rgba(236, 72, 153, 0.15);
        }
        .pink-glow { box-shadow: 0 0 20px rgba(236, 72, 153, 0.4); }
        .gradient-text {
            background: linear-gradient(90deg, #ec4899, #f472b6, #f9a8d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .tab-active {
            background: linear-gradient(90deg, #ec4899, #f472b6);
            color: white !important;
        }
        .color-block {
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.3), rgba(244, 114, 182, 0.2));
            border: 1px solid rgba(236, 72, 153, 0.5);
        }
    </style>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center pink-glow">
                    <span class="text-2xl">📰</span>
                </div>
                <h2 class="font-black text-3xl gradient-text">News Dashboard</h2>
            </div>
            <div class="flex items-center gap-2 color-block px-4 py-2 rounded-xl">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-white text-sm font-bold">LIVE</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-b from-black via-gray-900 to-black min-h-screen" x-data="{ activeTab: 'profile' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- FUNCTIONAL TABS -->
            <div class="glass rounded-2xl p-2 mb-8 flex gap-2">
                <button @click="activeTab = 'profile'" 
                        :class="activeTab === 'profile' ? 'tab-active' : 'text-pink-300'"
                        class="flex-1 px-6 py-3 rounded-xl font-bold transition-all">
                    👤 Profile
                </button>
                <button @click="activeTab = 'api'" 
                        :class="activeTab === 'api' ? 'tab-active' : 'text-pink-300'"
                        class="flex-1 px-6 py-3 rounded-xl font-bold transition-all">
                    🔌 Your API
                </button>
                <button @click="activeTab = 'news'" 
                        :class="activeTab === 'news' ? 'tab-active' : 'text-pink-300'"
                        class="flex-1 px-6 py-3 rounded-xl font-bold transition-all">
                    📰 Public API
                </button>
            </div>

            <!-- TAB 1: USER PROFILE WITH COLOR BLOCKS -->
            <div x-show="activeTab === 'profile'" class="space-y-6">
                <div class="glass rounded-3xl p-8">
                    <h2 class="text-pink-500 text-2xl font-bold mb-6 flex items-center gap-3">
                        <span class="color-block px-4 py-2 rounded-xl">👤</span> 
                        <span class="color-block px-4 py-2 rounded-xl text-white">Logged-in User Info</span>
                    </h2>
                    
                    <div class="flex items-center gap-6 mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-pink-500 to-pink-600 rounded-3xl flex items-center justify-center text-5xl pink-glow">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="space-y-2">
                            <div class="color-block px-6 py-3 rounded-xl inline-block">
                                <span class="text-3xl font-black text-white">{{ Auth::user()->name }}</span>
                            </div>
                            <div class="color-block px-4 py-2 rounded-xl inline-block">
                                <span class="text-pink-100 font-bold">{{ Auth::user()->role }} Account</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="color-block rounded-xl p-5">
                            <div class="text-pink-200 text-xs font-bold mb-2 uppercase">EMAIL ADDRESS</div>
                            <div class="text-white font-bold text-sm break-all">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="color-block rounded-xl p-5">
                            <div class="text-pink-200 text-xs font-bold mb-2 uppercase">USER ROLE</div>
                            <div class="text-white font-black text-lg">{{ Auth::user()->role }}</div>
                        </div>
                        <div class="color-block rounded-xl p-5">
                            <div class="text-pink-200 text-xs font-bold mb-2 uppercase">USER ID</div>
                            <div class="text-white font-black text-2xl">#{{ Auth::user()->id }}</div>
                        </div>
                        <div class="color-block rounded-xl p-5">
                            <div class="text-pink-200 text-xs font-bold mb-2 uppercase">MEMBER SINCE</div>
                            <div class="text-white font-bold text-sm">{{ Auth::user()->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: YOUR API WITH COLOR BLOCKS -->
            <div x-show="activeTab === 'api'" class="space-y-6">
                <div class="glass rounded-3xl p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-pink-500 text-2xl font-bold flex items-center gap-3">
                            <span class="color-block px-4 py-2 rounded-xl">🔌</span>
                            <span class="color-block px-4 py-2 rounded-xl text-white">System Users (Your API)</span>
                        </h2>
                        <button onclick="document.getElementById('apiFrame').src = document.getElementById('apiFrame').src" 
                                class="color-block px-4 py-2 rounded-xl text-white font-bold hover:scale-105 transition">
                            🔄 Refresh
                        </button>
                    </div>
                    
                    <div class="color-block rounded-xl p-4 mb-4">
                        <div class="text-pink-200 text-xs font-bold mb-1 uppercase">API ENDPOINT</div>
                        <code class="text-white font-bold text-sm">GET http://127.0.0.1:8000/api/users</code>
                    </div>

                    <div class="color-block rounded-xl p-4">
                        <iframe id="apiFrame" src="/api/users" class="w-full h-96 bg-gray-900 rounded-xl"></iframe>
                    </div>
                    
                    <div class="color-block rounded-xl p-3 mt-4 text-center">
                        <span class="text-pink-100 text-xs font-semibold">* Data from your Laravel API using User::all()</span>
                    </div>
                </div>
            </div>

            <!-- TAB 3: PUBLIC API WITH COLOR BLOCKS -->
            <div x-show="activeTab === 'news'" class="space-y-6" x-data="{ searchQuery: '' }">
                <div class="glass rounded-3xl p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-pink-500 text-2xl font-bold flex items-center gap-3">
                            <span class="color-block px-4 py-2 rounded-xl">📰</span>
                            <span class="color-block px-4 py-2 rounded-xl text-white">Latest News (Public API)</span>
                        </h2>
                        <div class="color-block px-4 py-2 rounded-xl">
                            <input type="text" x-model="searchQuery" placeholder="Search news..." 
                                   class="bg-transparent text-white placeholder-pink-200 text-sm focus:outline-none">
                        </div>
                    </div>

                    @php
                        $news = app(\App\Http\Controllers\NewsController::class)->news();
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($news as $item)
                            <div x-show="searchQuery === '' || '{{ strtolower($item['title']) }}'.includes(searchQuery.toLowerCase())"
                                 class="color-block rounded-2xl overflow-hidden group hover:scale-105 hover:pink-glow transition-all duration-300">
                                
                                <div class="relative h-48 overflow-hidden">
                                    @if($item['urlToImage'] ?? false)
                                        <img src="{{ $item['urlToImage'] }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-pink-900 to-black flex items-center justify-center">
                                            <span class="text-7xl opacity-50">📰</span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                                    <div class="absolute top-3 right-3 px-3 py-1 bg-pink-500 rounded-full text-white text-xs font-black">
                                        LIVE
                                    </div>
                                </div>

                                <div class="p-5 space-y-3">
                                    <div class="color-block px-3 py-2 rounded-lg">
                                        <h3 class="font-black text-white text-lg line-clamp-2">
                                            {{ $item['title'] }}
                                        </h3>
                                    </div>
                                    
                                    <div class="color-block px-3 py-2 rounded-lg">
                                        <p class="text-sm text-pink-100 line-clamp-3">
                                            {{ $item['description'] ?? 'No description available' }}
                                        </p>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="color-block px-3 py-1 rounded-lg">
                                            <span class="text-xs text-pink-200 font-bold">
                                                {{ \Carbon\Carbon::parse($item['publishedAt'] ?? now())->diffForHumans() }}
                                            </span>
                                        </div>
                                        <a href="{{ $item['url'] }}" target="_blank"
                                           class="color-block px-4 py-2 rounded-xl hover:scale-105 transition-all">
                                            <span class="text-white font-black text-sm flex items-center gap-2">
                                                READ 
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 color-block rounded-2xl p-16 text-center">
                                <div class="text-8xl mb-6">📭</div>
                                <div class="color-block px-6 py-3 rounded-xl inline-block">
                                    <p class="text-white text-2xl font-black">No News Available</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-app-layout>