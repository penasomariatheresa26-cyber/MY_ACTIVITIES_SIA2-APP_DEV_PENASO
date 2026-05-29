<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration System</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { background: #111; }
    .btn-hover:hover { transform: scale(1.05); transition: 0.3s; }
</style>
</head>
<body class="min-h-screen flex flex-col items-center py-10">

<div class="bg-gradient-to-r from-pink-500 to-black rounded-xl shadow-2xl w-full max-w-6xl p-8">
    <h1 class="text-4xl font-bold text-white text-center mb-6">Student Registration System</h1>

    <!-- Tabs -->
    <div class="flex justify-center space-x-4 mb-8">
        <a href="{{ route('form.create') }}" class="px-6 py-2 rounded-lg font-semibold btn-hover {{ ($activeTab=='register') ? 'bg-black text-pink-500' : 'bg-white text-black hover:bg-pink-300' }}">Register</a>
        <a href="{{ route('form.view') }}" class="px-6 py-2 rounded-lg font-semibold btn-hover {{ ($activeTab=='view') ? 'bg-black text-pink-500' : 'bg-white text-black hover:bg-pink-300' }}">View Students</a>
        <a href="{{ route('form.dashboard') }}" class="px-6 py-2 rounded-lg font-semibold btn-hover {{ ($activeTab=='dashboard') ? 'bg-black text-pink-500' : 'bg-white text-black hover:bg-pink-300' }}">Dashboard</a>
    </div>

    <!-- Success -->
    @if(session('success'))
    <div class="bg-green-600 text-white p-3 rounded mb-4 text-center font-semibold">
        {{ session('success') }}
    </div>
    @endif

    <!-- Registration Form -->
    @if($activeTab=='register')
    <form action="{{ route('form.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

            <div><label class="text-white font-semibold">Mobile Number</label><input type="text" name="mobile" value="{{ old('mobile') }}" class="w-full p-2 rounded text-black">@error('mobile')<span class="text-yellow-200 text-sm">{{ $message }}</span>@enderror</div>

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
        </div>

        <div><label class="text-white font-semibold">Additional Notes</label><textarea name="notes" rows="3" class="w-full p-2 rounded text-black">{{ old('notes') }}</textarea></div>

        <div class="text-center">
            <button type="submit" class="bg-black text-pink-500 px-8 py-2 rounded font-bold hover:bg-white hover:text-pink-500 transition btn-hover">Register</button>
        </div>
    </form>
    @endif

    <!-- View Students -->
    @if($activeTab=='view')
    <div class="overflow-x-auto">
    <table class="w-full text-black bg-white rounded-lg shadow-lg overflow-hidden mt-4">
        <thead class="bg-pink-500 text-white">
            <tr>
                <th class="p-2">Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Course</th>
                <th>Mobile</th>
                <th>Barangay</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr class="text-center border-b hover:bg-pink-100">
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->age }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->mobile }}</td>
                <td>{{ $student->barangay }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @endif

    <!-- Dashboard -->
    @if($activeTab=='dashboard')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-white mt-6">
        <div class="bg-pink-500 p-6 rounded-lg shadow-lg text-center hover:scale-105 transition">
            <h2 class="text-2xl font-bold">Total Students</h2>
            <p class="text-4xl mt-2">{{ $total }}</p>
        </div>
        <div class="bg-pink-500 p-6 rounded-lg shadow-lg text-center hover:scale-105 transition">
            <h2 class="text-2xl font-bold">Average Age</h2>
            <p class="text-4xl mt-2">{{ round($averageAge,1) }}</p>
        </div>
    </div>
    @endif
</div>

</body>
</html>