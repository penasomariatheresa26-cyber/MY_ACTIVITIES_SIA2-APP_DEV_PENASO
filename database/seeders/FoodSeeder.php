<?php
namespace Database\Seeders;
use App\Models\Food;
use Illuminate\Database\Seeder;
class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            [
                'name' => 'Chicken Adobo',
                'description' => 'Classic Filipino braised chicken in soy sauce and vinegar with garlic and bay leaves',
                'price' => 180.00,
                'category' => 'Main Course',
                'is_available' => true,
            ],
            [
                'name' => 'Sinigang na Baboy',
                'description' => 'Sour pork soup with vegetables in tamarind broth - a Filipino comfort food',
                'price' => 220.00,
                'category' => 'Main Course',
                'is_available' => true,
            ],
            [
                'name' => 'Kare-Kare',
                'description' => 'Rich peanut-based stew with oxtail, tripe, and vegetables served with shrimp paste',
                'price' => 280.00,
                'category' => 'Main Course',
                'is_available' => true,
            ],
            [
                'name' => 'Crispy Pata',
                'description' => 'Deep-fried pork leg that is crispy outside and tender inside',
                'price' => 450.00,
                'category' => 'Main Course',
                'is_available' => true,
            ],
            [
                'name' => 'Pancit Canton',
                'description' => 'Stir-fried egg noodles with vegetables, meat, and savory sauce',
                'price' => 120.00,
                'category' => 'Noodles',
                'is_available' => true,
            ],
            [
                'name' => 'Lumpiang Shanghai',
                'description' => 'Crispy Filipino spring rolls filled with seasoned ground pork',
                'price' => 150.00,
                'category' => 'Appetizers',
                'is_available' => true,
            ],
            [
                'name' => 'Fresh Garden Salad',
                'description' => 'Fresh mixed greens with tomatoes, cucumber, and house dressing',
                'price' => 95.00,
                'category' => 'Salads',
                'is_available' => true,
            ],
            [
                'name' => 'Halo-Halo',
                'description' => 'Filipino shaved ice dessert with sweet beans, jellies, fruits, and ube ice cream',
                'price' => 85.00,
                'category' => 'Desserts',
                'is_available' => true,
            ],
            [
                'name' => 'Lechon Kawali',
                'description' => 'Crispy pan-roasted pork belly served with liver sauce',
                'price' => 220.00,
                'category' => 'Main Course',
                'is_available' => true,
            ],
            [
                'name' => 'Bicol Express',
                'description' => 'Spicy pork dish cooked in coconut milk with lots of chili peppers',
                'price' => 200.00,
                'category' => 'Main Course',
                'is_available' => true,
            ],
        ];
        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}