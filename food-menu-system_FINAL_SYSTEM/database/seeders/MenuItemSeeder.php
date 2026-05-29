<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Classic Beef Burger',
                'description' => 'Juicy beef patty with lettuce, tomato, cheese, and signature sauce on a toasted brioche bun.',
                'price' => 189.00,
                'category' => 'meal',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Crispy Fried Chicken',
                'description' => 'Golden crispy fried chicken served with coleslaw and gravy.',
                'price' => 249.00,
                'category' => 'meal',
                'image' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Margherita Pizza',
                'description' => '12-inch pizza with fresh mozzarella, basil, and San Marzano tomato sauce.',
                'price' => 329.00,
                'category' => 'meal',
                'image' => 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Grilled Salmon Bowl',
                'description' => 'Fresh Atlantic salmon on quinoa, mixed greens, avocado, and citrus dressing.',
                'price' => 379.00,
                'category' => 'meal',
                'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Creamy Carbonara',
                'description' => 'Al dente pasta in a rich, creamy egg and parmesan sauce with crispy bacon bits.',
                'price' => 269.00,
                'category' => 'meal',
                'image' => 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Strawberry Milkshake',
                'description' => 'Thick and creamy milkshake made with real strawberries, topped with whipped cream.',
                'price' => 139.00,
                'category' => 'beverage',
                'image' => 'https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Iced Caramel Latte',
                'description' => 'Espresso poured over ice with caramel syrup and your choice of milk.',
                'price' => 149.00,
                'category' => 'beverage',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Fresh Lemonade',
                'description' => 'Freshly squeezed lemonade with the perfect balance of sweet and tart.',
                'price' => 99.00,
                'category' => 'beverage',
                'image' => 'https://images.unsplash.com/photo-1621263764928-df1444c5e859?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Chocolate Lava Cake',
                'description' => 'Warm, rich chocolate cake with a molten center. Served with vanilla ice cream.',
                'price' => 199.00,
                'category' => 'dessert',
                'image' => 'https://images.unsplash.com/photo-1624353365286-3f8d62daad51?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Mango Cheesecake',
                'description' => 'Smooth cheesecake topped with fresh Philippine mango slices and mango puree.',
                'price' => 179.00,
                'category' => 'dessert',
                'image' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Buko Pandan Sundae',
                'description' => 'Young coconut and pandan jelly layered with creamy ice cream and leche flan.',
                'price' => 159.00,
                'category' => 'dessert',
                'image' => 'https://images.unsplash.com/photo-1501443762994-82bd5dace89a?w=400&h=300&fit=crop',
                'available' => true,
            ],
            [
                'name' => 'Garlic Parmesan Wings',
                'description' => 'Crispy chicken wings tossed in garlic parmesan butter. Served with ranch dip.',
                'price' => 219.00,
                'category' => 'other',
                'image' => 'https://images.unsplash.com/photo-1608039829572-9b6d559a5f32?w=400&h=300&fit=crop',
                'available' => true,
            ],
        ];

        foreach ($items as $item) {
            MenuItem::create($item);
        }
    }
}