<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theresse - Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-stone-900 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border-t-4 border-amber-500">
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-stone-800 rounded-full flex items-center justify-center text-amber-400 font-bold text-xl mx-auto mb-3"><i class="fa-solid fa-lock"></i></div>
            <h2 class="text-2xl font-bold text-stone-900">Admin Dashboard Login</h2>
            <p class="text-sm text-gray-500 mt-1">Please enter your control credentials</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Admin Email</label>
                <input type="email" name="email" required autofocus class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Security Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>

            <button type="submit" class="w-full bg-stone-800 text-amber-400 py-3 rounded-xl font-bold hover:bg-stone-700 transition duration-200">
                Authenticate Secure Access
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Need an account? <a href="{{ route('admin.register') }}" class="text-amber-600 font-medium hover:underline">Request Authority</a>
        </p>

        <div class="border-t border-gray-100 mt-6 pt-4 text-center">
            <a href="{{ route('login') }}" class="text-xs font-semibold text-gray-400 hover:text-gray-600 uppercase tracking-wider"><i class="fa-solid fa-arrow-left mr-1"></i> Back to User Login</a>
        </div>
    </div>
</body>
</html>