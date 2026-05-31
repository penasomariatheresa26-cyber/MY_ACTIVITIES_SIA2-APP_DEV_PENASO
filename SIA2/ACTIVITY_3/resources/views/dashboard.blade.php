<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-fuchsia-50 p-8">
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-xl p-6">
        <h1 class="text-3xl font-bold text-fuchsia-700 mb-4">Volunteer Dashboard</h1>
        <p class="mb-4 font-semibold">Total Volunteers: <span class="text-fuchsia-700">{{ $total }}</span></p>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-fuchsia-100">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Age</th>
                    <th class="border p-2">Area</th>
                    <th class="border p-2">Motivation</th>
                </tr>
            </thead>
            <tbody>
                @forelse($volunteers as $v)
                <tr class="hover:bg-fuchsia-50">
                    <td class="border p-2">{{ $v->id }}</td>
                    <td class="border p-2">{{ $v->name }}</td>
                    <td class="border p-2">{{ $v->email }}</td>
                    <td class="border p-2">{{ $v->age }}</td>
                    <td class="border p-2">{{ $v->area }}</td>
                    <td class="border p-2">{{ $v->motivation }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="border p-2 text-center">No volunteers registered yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('volunteer.create') }}" class="block mt-4 text-fuchsia-700 hover:underline">Back to Registration</a>
    </div>
</body>
</html>