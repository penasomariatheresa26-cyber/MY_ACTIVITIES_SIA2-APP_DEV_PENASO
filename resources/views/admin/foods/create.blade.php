<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body class="bg-pink-50 min-h-screen">

    <div class="max-w-3xl mx-auto py-10 px-4">

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-pink-100">

            <!-- HEADER -->
            <div class="bg-pink-600 text-white px-8 py-6">

                <h1 class="text-3xl font-bold">
                    <i class="fa-solid fa-utensils"></i>
                    Add New Food
                </h1>

                <p class="text-pink-100 mt-2">
                    Admin Food Management
                </p>

            </div>

            <!-- FORM -->
            <div class="p-8">

                <form method="POST"
                action="{{ route('admin.foods.store') }}"
                enctype="multipart/form-data"
                class="space-y-6">

                    @csrf

                    <!-- FOOD NAME -->
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">
                            Food Name
                        </label>

                        <input
                        type="text"
                        name="name"
                        required
                        class="w-full border border-pink-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Enter food name">

                    </div>

                    <!-- CATEGORY -->
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">
                            Category
                        </label>

                        <input
                        type="text"
                        name="category"
                        required
                        class="w-full border border-pink-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="e.g. Drinks, Meals">

                    </div>

                    <!-- PRICE -->
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">
                            Price
                        </label>

                        <input
                        type="number"
                        step="0.01"
                        name="price"
                        required
                        class="w-full border border-pink-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Enter price">

                    </div>

                    <!-- DESCRIPTION -->
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">
                            Description
                        </label>

                        <textarea
                        name="description"
                        rows="4"
                        class="w-full border border-pink-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Enter food description"></textarea>

                    </div>

                    <!-- IMAGE -->
                    <div>

                        <label class="block mb-2 font-semibold text-gray-700">
                            Food Image
                        </label>

                        <input
                        type="file"
                        name="image"
                        class="w-full border border-pink-200 rounded-xl px-4 py-3 bg-white">

                    </div>

                    <!-- SUBMIT -->
                    <div class="flex gap-4">

                        <button
                        type="submit"
                        class="bg-pink-600 hover:bg-pink-700 text-white px-8 py-3 rounded-2xl font-bold shadow-lg transition">

                            <i class="fa-solid fa-plus"></i>
                            Add Food

                        </button>

                        <a href="{{ route('admin.foods.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-2xl font-bold transition">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>