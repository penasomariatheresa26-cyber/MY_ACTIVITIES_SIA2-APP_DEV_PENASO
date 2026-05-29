<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theresse Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-pink-50 min-h-screen">

    <div class="flex justify-center items-center py-10 px-4">
        <div class="bg-white w-full max-w-md rounded-3xl shadow-xl overflow-hidden border border-pink-100">
            
            <div class="bg-pink-600 text-white text-center py-10 px-6">
                <h2 class="text-5xl font-bold mb-2 font-serif">Welcome Back</h2>
                <p class="text-pink-100">Sign in to your Theresse account</p>
            </div>

            <div class="p-6">
                <form id="loginForm" method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <button type="button" id="customerBtn" 
                            onclick="setLoginType('customer', '{{ route('login.submit') }}')"
                            class="bg-pink-500 text-white py-3 rounded-xl font-semibold transition">
                            <i class="fa-regular fa-user"></i> Customer
                        </button>
                        <button type="button" id="adminBtn" 
                            onclick="setLoginType('admin', '{{ route('admin.login.submit') }}')"
                            class="bg-pink-100 text-pink-600 py-3 rounded-xl font-semibold transition">
                            <i class="fa-solid fa-shield-halved"></i> Admin
                        </button>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" required class="w-full border border-pink-200 rounded-xl px-4 py-3">
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" required class="w-full border border-pink-200 rounded-xl px-4 py-3">
                    </div>

                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white py-4 rounded-2xl font-bold text-lg">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function setLoginType(type, url) {
            const form = document.getElementById('loginForm');
            const customerBtn = document.getElementById('customerBtn');
            const adminBtn = document.getElementById('adminBtn');
            
            // Update Form Action
            form.action = url;

            // Update UI Colors
            if (type === 'admin') {
                adminBtn.classList.add('bg-pink-500', 'text-white');
                adminBtn.classList.remove('bg-pink-100', 'text-pink-600');
                customerBtn.classList.add('bg-pink-100', 'text-pink-600');
                customerBtn.classList.remove('bg-pink-500', 'text-white');
            } else {
                customerBtn.classList.add('bg-pink-500', 'text-white');
                customerBtn.classList.remove('bg-pink-100', 'text-pink-600');
                adminBtn.classList.add('bg-pink-100', 'text-pink-600');
                adminBtn.classList.remove('bg-pink-500', 'text-white');
            }
        }
    </script>
</body>
</html>
<div class="bg-pink-50 border border-pink-200 rounded-2xl p-4 mt-4">
    <h3 class="font-bold text-pink-700 mb-2">
        Demo Admin Account
    </h3>
    <p class="text-sm text-gray-700">
        Email: <strong>admin@theresse.com</strong>
    </p>
    <p class="text-sm text-gray-700">
        Password: <strong>admin123</strong>
    </p>
</div>