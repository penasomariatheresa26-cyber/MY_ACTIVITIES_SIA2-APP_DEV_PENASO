<x-guest-layout>
    <style>
        body { background: #000 !important; }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(236, 72, 153, 0.3);
            box-shadow: 0 0 40px rgba(236, 72, 153, 0.2);
        }
    </style>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-black p-4">
        <div class="w-full max-w-md">
            
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl items-center justify-center mb-4 shadow-lg shadow-pink-500/50">
                    <span class="text-4xl">📰</span>
                </div>
                <h1 class="text-4xl font-black bg-gradient-to-r from-pink-500 to-pink-300 bg-clip-text text-transparent">
                    News Dashboard
                </h1>
                <p class="text-pink-300/70 mt-2">Welcome back</p>
            </div>

            <!-- Login Card -->
            <div class="glass rounded-3xl p-8">
                <x-auth-session-status class="mb-4 text-pink-300" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-pink-300 font-semibold" />
                        <x-text-input id="email" class="block mt-2 w-full bg-black/40 border-pink-500/40 text-white rounded-xl focus:border-pink-500 focus:ring-pink-500/50" 
                                      type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-400" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="password" :value="__('Password')" class="text-pink-300 font-semibold" />
                        <x-text-input id="password" class="block mt-2 w-full bg-black/40 border-pink-500/40 text-white rounded-xl focus:border-pink-500 focus:ring-pink-500/50"
                                      type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-400" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="rounded bg-black/40 border-pink-500/40 text-pink-500 focus:ring-pink-500/50" name="remember">
                            <span class="ms-2 text-sm text-pink-300">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-pink-400 hover:text-pink-300" href="{{ route('password.request') }}">
                                Forgot?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full mt-8 bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white font-bold py-3 rounded-xl transition-all shadow-lg shadow-pink-500/50">
                        Sign In
                    </button>
                </form>
            </div>

            <p class="text-center mt-6 text-pink-300/60 text-sm">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-pink-400 hover:text-pink-300 font-semibold">Sign up</a>
            </p>
        </div>
    </div>
</x-guest-layout>