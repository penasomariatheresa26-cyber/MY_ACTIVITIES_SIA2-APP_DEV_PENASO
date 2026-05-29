<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration System</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black min-h-screen flex flex-col items-center py-10">

<div class="bg-pink-500 rounded-xl shadow-2xl w-full max-w-4xl p-8">
<h1 class="text-3xl font-bold text-white text-center mb-6">Student Registration System</h1>

<!-- Tabs -->
<div class="flex justify-center space-x-4 mb-6">
    <a href="{{ route('form.create') }}" class="px-4 py-2 rounded-lg font-semibold transition {{ (request()->routeIs('form.create')) ? 'bg-black text-pink-500' : 'bg-white text-black hover:bg-pink-300' }}">Register</a>
    <a href="{{ route('form.view') }}" class="px-4 py-2 rounded-lg font-semibold transition {{ (request()->routeIs('form.view')) ? 'bg-black text-pink-500' : 'bg-white text-black hover:bg-pink-300' }}">View</a>
    <a href="{{ route('form.dashboard') }}" class="px-4 py-2 rounded-lg font-semibold transition {{ (request()->routeIs('form.dashboard')) ? 'bg-black text-pink-500' : 'bg-white text-black hover:bg-pink-300' }}">Dashboard</a>
</div>

<!-- Success -->
@if(session('success'))
<div class="bg-green-600 text-white p-3 rounded mb-4 text-center">
    {{ session('success') }}
</div>
@endif

<!-- Registration Form -->
@if(request()->routeIs('form.create'))
<form action="{{ route('form.store') }}" method="POST" class="space-y-4">
    @csrf
    <div><label class="text-white font-semibold">Full Name</label><input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 rounded text-black">@error('name')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror</div>

    <div><label class="text-white font-semibold">Email</label><input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 rounded text-black">@error('email')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror</div>

    <div><label class="text-white font-semibold">Age</label><input type="number" name="age" value="{{ old('age') }}" class="w-full p-2 rounded text-black">@error('age')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror</div>

    <div><label class="text-white font-semibold">Course</label>
        <select name="course" class="w-full p-2 rounded text-black">
            <option value="">--Select Course--</option>
            <option value="Computer Science" {{ old('course')=='Computer Science'?'selected':'' }}>Computer Science</option>
            <option value="Information Technology" {{ old('course')=='Information Technology'?'selected':'' }}>Information Technology</option>
            <option value="Engineering" {{ old('course')=='Engineering'?'selected':'' }}>Engineering</option>
        </select>
        @error('course')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror
    </div>

    <div><label class="text-white font-semibold">Mobile Number</label><input type="text" name="mobile" value="{{ old('mobile') }}" class="w-full p-2 rounded text-black" placeholder="09XXXXXXXXX">@error('mobile')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror</div>

    <div><label class="text-white font-semibold">Barangay</label><input type="text" name="barangay" value="{{ old('barangay') }}" class="w-full p-2 rounded text-black">@error('barangay')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror</div>

    <div><label class="text-white font-semibold">Emergency Contact</label><input type="text" name="emergency_contact" value="{{ old('emergency_contact') }}" class="w-full p-2 rounded text-black">@error('emergency_contact')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror</div>

    <div><label class="text-white font-semibold">Gender</label>
        <select name="gender" class="w-full p-2 rounded text-black">
            <option value="">--Select Gender--</option>
            <option value="Male" {{ old('gender')=='Male'?'selected':'' }}>Male</option>
            <option value="Female" {{ old('gender')=='Female'?'selected':'' }}>Female</option>
        </select>
        @error('gender')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror
    </div>

    <div><label class="text-white font-semibold">Guardian Name</label><input type="text" name="guardian_name" value="{{ old('guardian_name') }}" class="w-full p-2 rounded text-black">@error('guardian_name')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror</div>

    <div><label class="text-white font-semibold">Guardian Contact</label><input type="text" name="guardian_contact" value="{{ old('guardian_contact') }}" class="w-full p-2 rounded text-black">@error('guardian_contact')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror</div>

    <div><label class="text-white font-semibold">Additional Notes</label><textarea name="notes" rows="3" class="w-full p-2 rounded text-black">{{ old('notes') }}</textarea></div>

    <div class="text-center">
        <button type="submit" class="bg-black text-pink-500 px-6 py-2 rounded font-bold hover:bg-white hover:text-pink-500 transition">Register</button>
    </div>
</form>
@endif
</div>
</body>
</html>