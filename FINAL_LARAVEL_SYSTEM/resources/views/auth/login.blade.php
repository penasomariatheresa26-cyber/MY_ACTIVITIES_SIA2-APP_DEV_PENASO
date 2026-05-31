<x-guest-layout>

<style>
    body {
        background: linear-gradient(135deg, #ffdde1, #ee9ca7);
    }

    .login-card {
        background: #fff0f5;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .login-title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #d63384;
        margin-bottom: 20px;
    }

    input {
        border-radius: 10px !important;
        border: 1px solid #f7a8c4 !important;
    }

    input:focus {
        border-color: #ff4d88 !important;
        box-shadow: 0 0 5px #ff4d88;
    }

    .x-primary-button,
    button {
        background-color: #ff4d88 !important;
        border-radius: 10px !important;
        border: none !important;
        color: white !important;
    }

    .x-primary-button:hover,
    button:hover {
        background-color: #e60073 !important;
    }

    a {
        color: #d63384 !important;
    }

    a:hover {
        color: #ff4d88 !important;
    }

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
</style>

<div class="center">

    <div class="login-card" style="width:400px;">

        <div class="login-title">
            🌸 Bloomery Login
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email"
                              class="block mt-1 w-full"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
                              autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="Password" />
                <x-text-input id="password"
                              class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox"
                           class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500"
                           name="remember">
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-4">

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm underline">
                        Forgot password?
                    </a>
                @endif

                <x-primary-button>
                    Log in
                </x-primary-button>

            </div>

            <!-- Register Link -->
            <div class="mt-4 text-center">
                <p>
                    Don't have an account?
                    <a href="{{ route('register') }}">Register here</a>
                </p>
            </div>

        </form>

    </div>

</div>

</x-guest-layout>