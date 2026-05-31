<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Registration</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-fuchsia-50 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
        <h1 class="text-3xl font-bold text-center text-fuchsia-700 mb-6">Volunteer Registration</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-fuchsia-100 text-fuchsia-700 p-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('volunteer.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="w-full border border-gray-300 p-2 rounded @error('name') border-fuchsia-500 @enderror">
                @error('name') <span class="text-fuchsia-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="w-full border border-gray-300 p-2 rounded @error('email') border-fuchsia-500 @enderror">
                @error('email') <span class="text-fuchsia-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Age</label>
                <input type="number" name="age" value="{{ old('age') }}" 
                       class="w-full border border-gray-300 p-2 rounded @error('age') border-fuchsia-500 @enderror">
                @error('age') <span class="text-fuchsia-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Preferred Area</label>
                <select name="area" class="w-full border border-gray-300 p-2 rounded @error('area') border-fuchsia-500 @enderror">
                    <option value="">Select</option>
                    <option value="Teaching" {{ old('area') == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                    <option value="Medical" {{ old('area') == 'Medical' ? 'selected' : '' }}>Medical</option>
                    <option value="Community Service" {{ old('area') == 'Community Service' ? 'selected' : '' }}>Community Service</option>
                </select>
                @error('area') <span class="text-fuchsia-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Motivation</label>
                <textarea name="motivation" rows="3" class="w-full border border-gray-300 p-2 rounded @error('motivation') border-fuchsia-500 @enderror">{{ old('motivation') }}</textarea>
                @error('motivation') <span class="text-fuchsia-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-fuchsia-600 text-white p-2 rounded hover:bg-fuchsia-700 transition-colors">Register</button>
        </form>

        <a href="{{ route('volunteer.dashboard') }}" class="block mt-4 text-center text-fuchsia-700 hover:underline">
            View Dashboard
        </a>
    </div>
</body>
</html>