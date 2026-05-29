<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Wipe existing temporary items first to prevent duplicates
        Food::truncate();

        Food::create([
            'name' => 'Pork Adobo Elegante',
            'description' => 'Tender pork belly braised slowly in a rich, savory blend of soy sauce, vinegar, garlic, and cracked black peppercorns.',
            'price' => 245.00,
            'category' => 'Main Dish',
            'image' => 'adobo.jpg',
            'is_available' => true,
        ]);

        Food::create([
            'name' => 'Sizzling Pork Sisig',
            'description' => 'Finely chopped crispy pork face and ears seasoned with calamansi, onions, and chili peppers, served on a sizzling hot plate.',
            'price' => 280.00,
            'category' => 'Sizzling',
            'image' => 'sisig.jpg',
            'is_available' => true,
        ]);

        Food::create([
            'name' => 'Classic Halo-Halo Supreme',
            'description' => 'Shaved ice layered with sweet beans, jelly, leche flan, ube halaya, and topped with rich evaporated milk and ube ice cream.',
            'price' => 150.00,
            'category' => 'Dessert',
            'image' => 'halohalo.jpg',
            'is_available' => true,
        ]);

        Food::create([
            'name' => 'Crispy Lumpia Shanghai',
            'description' => 'Golden brown, deep-fried spring rolls packed with seasoned ground pork and vegetables, served with a sweet and sour dip.',
            'price' => 120.00,
            'category' => 'Appetizer',
            'image' => 'lumpia.jpg',
            'is_available' => true,
        ]);
    }
}