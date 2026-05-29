<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theresse - Admin Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-stone-900 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border-t-4 border-amber-500">
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-stone-800 rounded-full flex items-center justify-center text-amber-400 font-bold text-xl mx-auto mb-3"><i class="fa-solid fa-user-shield"></i></div>
            <h2 class="text-2xl font-bold text-stone-900">Admin Gateway</h2>
            <p class="text-sm text-gray-500 mt-1">Register structural management access</p>
        </div>

        <form method="POST" action="{{ route('admin.register') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Admin Name</label>
                <input type="text" name="name" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Admin Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Security Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Security Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>

            <button type="submit" class="w-full bg-stone-800 text-amber-400 py-3 rounded-xl font-bold hover:bg-stone-700 transition duration-200">
                Register Authority
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Already have an account? <a href="{{ route('admin.login') }}" class="text-amber-600 font-medium hover:underline">Admin Login</a>
        </p>
    </div>
</body>
</html>