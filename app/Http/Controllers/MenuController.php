<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $allFoods = Food::query();

        if ($request->has('category') && !empty($request->category)) {
            $allFoods->where('category', $request->category);
        }

        $allFoods = $allFoods->get();

        // 20-ITEM MASSIVE FALLBACK MENU SYSTEM
        if ($allFoods->isEmpty()) {
            $mockFoods = collect([
                // === RICE MEALS ===
                (object)[
                    'id' => 1, 'name' => 'Pork Adobo Elegante', 'category' => 'Rice Meals', 'price' => 245.00,
                    'description' => 'Tender pork belly braised slowly in a rich, savory blend of soy sauce, vinegar, garlic, and cracked peppercorns, served with steamed rice.',
                    'image' => 'https://images.pexels.com/photos/15015354/pexels-photo-15015354/free-photo-of-braised-meat-served-in-a-bowl.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 2, 'name' => 'Beef Kaldereta Supreme', 'category' => 'Rice Meals', 'price' => 320.00,
                    'description' => 'Rich beef stew cooked in savory tomato sauce and liver spread, with bell peppers, potatoes, carrots, and melted cheese over rice.',
                    'image' => 'https://images.pexels.com/photos/20125585/pexels-photo-20125585/free-photo-of-a-bowl-of-beef-stew-with-vegetables.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 3, 'name' => 'Classic Chicken Inasal', 'category' => 'Rice Meals', 'price' => 195.00,
                    'description' => 'Lemongrass and calamansi marinated chicken quarter, grilled over hot coals and brushed with aromatic achiote chicken oil.',
                    'image' => 'https://images.pexels.com/photos/2232433/pexels-photo-2232433.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 4, 'name' => 'Crispy Lechon Kawali', 'category' => 'Rice Meals', 'price' => 260.00,
                    'description' => 'Deep-fried pork belly boiled until tender and fried until golden crispy, served with native liver sauce and rice.',
                    'image' => 'https://images.pexels.com/photos/9228527/pexels-photo-9228527.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 5, 'name' => 'Garlic Beef Tapa (Tapsilog)', 'category' => 'Rice Meals', 'price' => 165.00,
                    'description' => 'Cured sweet-salty garlic beef strips served with a mountain of fragrant garlic fried rice and a sunny-side-up egg.',
                    'image' => 'https://images.pexels.com/photos/22813136/pexels-photo-22813136/free-photo-of-delicious-breakfast-dish.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],

                // === SIZZLING ===
                (object)[
                    'id' => 6, 'name' => 'Sizzling Pork Sisig', 'category' => 'Sizzling', 'price' => 280.00,
                    'description' => 'Finely chopped crispy pork seasoned with calamansi, onions, and green chilies, served on a piping hot cast-iron plate.',
                    'image' => 'https://images.pexels.com/photos/18915732/pexels-photo-18915732/free-photo-of-meat-dish-served-on-cast-iron-skillet.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 7, 'name' => 'Sizzling Siga Gambas', 'category' => 'Sizzling', 'price' => 295.00,
                    'description' => 'Plump shrimp sautéed in a spicy, garlicky tomato sauce with bell peppers, served sizzling with an egg on top.',
                    'image' => 'https://images.pexels.com/photos/8993444/pexels-photo-8993444.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 8, 'name' => 'Sizzling Beef Pepper Rice', 'category' => 'Sizzling', 'price' => 240.00,
                    'description' => 'Thinly sliced premium beef strips surrounding sweet corn, butter, and freshly cracked black pepper on a hot platter plate.',
                    'image' => 'https://images.pexels.com/photos/7625056/pexels-photo-7625056.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],

                // === SOUPS ===
                (object)[
                    'id' => 9, 'name' => 'Sinigang na Baboy', 'category' => 'Soups', 'price' => 295.00,
                    'description' => 'Comforting sour tamarind broth loaded with tender pork ribs, native radish, kangkong greens, sitaw, and long green chilies.',
                    'image' => 'https://images.pexels.com/photos/12481161/pexels-photo-12481161.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 10, 'name' => 'Hearty Bulalo Supreme', 'category' => 'Soups', 'price' => 450.00,
                    'description' => 'Light colored soup made by cooking beef shanks and bone marrow with cabbage, sweet corn, and whole black peppercorns.',
                    'image' => 'https://images.pexels.com/photos/6999534/pexels-photo-6999534.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 11, 'name' => 'Creamy Chicken Sopas', 'category' => 'Soups', 'price' => 135.00,
                    'description' => 'Classic Filipino macaroni soup cooked in milk broth with shredded chicken breast, hotdog slices, carrots, and cabbage.',
                    'image' => 'https://images.pexels.com/photos/1435868/pexels-photo-1435868.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],

                // === NOODLES ===
                (object)[
                    'id' => 12, 'name' => 'Pancit Bihon Guisado', 'category' => 'Noodles', 'price' => 180.00,
                    'description' => 'Stir-fried thin rice noodles tossed with chicken flakes, shrimp, and crisp garden vegetables, seasoned with calamansi citrus.',
                    'image' => 'https://images.pexels.com/photos/10540455/pexels-photo-10540455.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 13, 'name' => 'Sweet Style Pancit Palabok', 'category' => 'Noodles', 'price' => 190.00,
                    'description' => 'Rice noodles drenched in a rich, savory golden shrimp sauce, topped with crushed chicharon, boiled egg, and fried garlic.',
                    'image' => 'https://images.pexels.com/photos/8448748/pexels-photo-8448748.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],

                // === DESSERTS ===
                (object)[
                    'id' => 14, 'name' => 'Classic Halo-Halo Supreme', 'category' => 'Desserts', 'price' => 150.00,
                    'description' => 'Shaved ice layered with sweet beans, nata de coco, leche flan, ube halaya, evaporated milk, and ube ice cream.',
                    'image' => 'https://images.pexels.com/photos/9211330/pexels-photo-9211330.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 15, 'name' => 'Velvety Leche Flan', 'category' => 'Desserts', 'price' => 95.00,
                    'description' => 'Rich, smooth, and ultra-creamy egg yolk caramel custard dessert topped with a golden sweet syrupy glaze sauce.',
                    'image' => 'https://images.pexels.com/photos/15900139/pexels-photo-15900139/free-photo-of-close-up-of-pudding.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 16, 'name' => 'Turon de Malacañang', 'category' => 'Desserts', 'price' => 75.00,
                    'description' => 'Deep-fried brown sugar coated spring roll wrappers stuffed with ripe saba banana slices and sweet jackfruit strip bits.',
                    'image' => 'https://images.pexels.com/photos/10350123/pexels-photo-10350123.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 17, 'name' => 'Mango Float Slice', 'category' => 'Desserts', 'price' => 110.00,
                    'description' => 'Chilled graham cracker icebox cake layered with thick sweet condensed cream and fresh slices of sweet ripe Philippine mangoes.',
                    'image' => 'https://images.pexels.com/photos/1028714/pexels-photo-1028714.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],

                // === DRINKS ===
                (object)[
                    'id' => 18, 'name' => 'Premium Samalamig (Sago\'t Gulaman)', 'category' => 'Drinks', 'price' => 55.00,
                    'description' => 'Refreshing local sweet drink blend made with brown sugar syrup, gelatin cubes, tapioca pearls, and crushed ice.',
                    'image' => 'https://images.pexels.com/photos/1233319/pexels-photo-1233319.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 19, 'name' => 'Calamansi Honey Ice Juice', 'category' => 'Drinks', 'price' => 65.00,
                    'description' => 'Freshly squeezed Philippine calamansi citrus lime juice sweetened with pure wild organic honey, served over ice rocks.',
                    'image' => 'https://images.pexels.com/photos/11940304/pexels-photo-11940304.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 20, 'name' => 'Creamy Avocado Shake', 'category' => 'Drinks', 'price' => 90.00,
                    'description' => 'Blended fresh ripe avocado fruit meat mixed with ice, condensed milk, and topped with rich milk powder flakes.',
                    'image' => 'https://images.pexels.com/photos/3625372/pexels-photo-3625372.jpeg?auto=compress&cs=tinysrgb&w=500'
                ]
            ]);

            if ($request->has('category') && !empty($request->category)) {
                $allFoods = $mockFoods->where('category', $request->category);
            } else {
                $allFoods = $mockFoods;
            }
            
            $categories = $mockFoods->pluck('category')->unique()->values();
        } else {
            $categories = Food::distinct()->pluck('category')->filter()->values();
        }

        return view('menu', compact('allFoods', 'categories'));
    }
}