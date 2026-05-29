<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-black flex items-center justify-center min-h-screen">

<div class="bg-pink-500 rounded-xl shadow-xl p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold text-center text-white mb-6">Student Registration</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display All Errors -->
    @if ($errors->any())
        <div class="bg-red-600 text-white p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('form.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="text-white font-semibold">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 rounded text-black">
            @error('name')
                <span class="text-yellow-200 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="text-white font-semibold">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 rounded text-black">
            @error('email')
                <span class="text-yellow-200 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="text-white font-semibold">Age</label>
            <input type="number" name="age" value="{{ old('age') }}" class="w-full p-2 rounded text-black">
            @error('age')
                <span class="text-yellow-200 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="text-white font-semibold">Course</label>
            <select name="course" class="w-full p-2 rounded text-black">
                <option value="">-- Select Course --</option>
                <option value="Computer Science" {{ old('course')=='Computer Science'?'selected':'' }}>Computer Science</option>
                <option value="Information Technology" {{ old('course')=='Information Technology'?'selected':'' }}>Information Technology</option>
                <option value="Engineering" {{ old('course')=='Engineering'?'selected':'' }}>Engineering</option>
            </select>
            @error('course')
                <span class="text-yellow-200 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="text-white font-semibold">Additional Notes</label>
            <textarea name="notes" rows="3" class="w-full p-2 rounded text-black">{{ old('notes') }}</textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-black text-pink-500 px-6 py-2 rounded font-bold hover:bg-white hover:text-pink-500 transition">Register</button>
        </div>
    </form>
</div>

</body>
</html>