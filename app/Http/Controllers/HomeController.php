<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featuredFoods = Food::take(6)->get();
        $categories = Food::distinct()->pluck('category')->filter()->values();

        return view('home', compact('categories', 'featuredFoods'));
    }

    /**
     * Show the complete menu page with 20 items fallback.
     */
    public function menu(Request $request)
    {
        $query = Food::query();

        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        $allFoods = $query->get();

        // If your database table is empty or missing our records, inject all 20 items dynamically!
        if ($allFoods->isEmpty() || $allFoods->count() < 20) {
            $mockFoods = collect([
                // === RICE MEALS ===
                (object)[
                    'id' => 1, 'name' => 'Pork Adobo Elegante', 'category' => 'Rice Meals', 'price' => 245.00,
                    'description' => 'Tender pork belly braised slowly in a rich, savory blend of soy sauce, vinegar, garlic, and cracked peppercorns, served with steamed rice.',
                    'image' => 'https://www.recipetineats.com/tachyon/2025/08/Pork-Adobo_2.jpg?resize=1200%2C1500&zoom=0.86'
                ],
                (object)[
                    'id' => 2, 'name' => 'Beef Kaldereta Supreme', 'category' => 'Rice Meals', 'price' => 320.00,
                    'description' => 'Rich beef stew cooked in savory tomato sauce and liver spread, with bell peppers, potatoes, carrots, and melted cheese over rice.',
                    'image' => 'https://tse3.mm.bing.net/th/id/OIP.vowOcVV3_6oAglZlyzuB6QHaHa?rs=1&pid=ImgDetMain&o=7&rm=3'
                ],
                (object)[
                    'id' => 3, 'name' => 'Classic Chicken Inasal', 'category' => 'Rice Meals', 'price' => 195.00,
                    'description' => 'Lemongrass and calamansi marinated chicken quarter, grilled over hot coals and brushed with aromatic achiote chicken oil.',
                    'image' => 'https://images.pexels.com/photos/2232433/pexels-photo-2232433.jpeg?auto=compress&cs=tinysrgb&w=500'
                ],
                (object)[
                    'id' => 4, 'name' => 'Crispy Lechon Kawali', 'category' => 'Rice Meals', 'price' => 260.00,
                    'description' => 'Deep-fried pork belly boiled until tender and fried until golden crispy, served with native liver sauce and rice.',
                    'image' => 'https://tse4.mm.bing.net/th/id/OIP.S6YM7Hk5YgFAdBTupppa2gHaE7?rs=1&pid=ImgDetMain&o=7&rm=3'
                ],
                (object)[
                    'id' => 5, 'name' => 'Garlic Beef Tapa (Tapsilog)', 'category' => 'Rice Meals', 'price' => 165.00,
                    'description' => 'Cured sweet-salty garlic beef strips served with a mountain of fragrant garlic fried rice and a sunny-side-up egg.',
                    'image' => 'https://thebakeologie.com/wp-content/uploads/2018/11/BeefTapa-1.jpg'
                ],

                // === SIZZLING ===
                (object)[
                    'id' => 6, 'name' => 'Sizzling Pork Sisig', 'category' => 'Sizzling', 'price' => 280.00,
                    'description' => 'Finely chopped crispy pork seasoned with calamansi, onions, and green chilies, served on a piping hot cast-iron plate.',
                    'image' => 'https://i.pinimg.com/736x/f3/76/f2/f376f26e1f1c97916b1afd459a3b3780.jpg'
                ],
                (object)[
                    'id' => 7, 'name' => 'Sizzling Siga Gambas', 'category' => 'Sizzling', 'price' => 295.00,
                    'description' => 'Plump shrimp sautéed in a spicy, garlicky tomato sauce with bell peppers, served sizzling with an egg on top.',
                    'image' => 'https://kusinasecrets.com/wp-content/uploads/2024/12/u3317447599_httpss.mj_.runxWgsVnDVhh8_top_down_view_of_sizzlin_f77e47e0-1071-44d0-822c-8fb6f3c780ab_0-780x780.jpg'
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
                    'image' => 'https://th.bing.com/th/id/R.ab68907ca02db57759d50f6fd912212c?rik=05sFzRUhV3ORvw&riu=http%3a%2f%2fimages.deliveryhero.io%2fimage%2ffoodpanda%2frecipes%2fbulalo-recipe-1.jpg&ehk=u%2f5M33nH8wqK8YacpD9A8TMneKeHwp07tpEyFgPlw%2fY%3d&risl=&pid=ImgRaw&r=0'
                ],
                (object)[
                    'id' => 11, 'name' => 'Creamy Chicken Sopas', 'category' => 'Soups', 'price' => 135.00,
                    'description' => 'Classic Filipino macaroni soup cooked in milk broth with shredded chicken breast, hotdog slices, carrots, and cabbage.',
                    'image' => 'https://www.primaverakitchen.com/wp-content/uploads/2022/10/Chicken-Noodle-Soup-Primavera-Kitchen-10-500x500.jpg'
                ],

                // === NOODLES ===
                (object)[
                    'id' => 12, 'name' => 'Pancit Bihon Guisado', 'category' => 'Noodles', 'price' => 180.00,
                    'description' => 'Stir-fried thin rice noodles tossed with chicken flakes, shrimp, and crisp garden vegetables, seasoned with calamansi citrus.',
                    'image' => 'https://yummykitchentv.com/wp-content/uploads/2023/02/pancit-bihon-gisado-recipe.jpg'
                ],
                (object)[
                    'id' => 13, 'name' => 'Sweet Style Pancit Palabok', 'category' => 'Noodles', 'price' => 190.00,
                    'description' => 'Rice noodles drenched in a rich, savory golden shrimp sauce, topped with crushed chicharon, boiled egg, and fried garlic.',
                    'image' => 'https://panlasangpinoy.com/wp-content/uploads/2017/10/Pancit-Palabok_.jpg'
                ],

                // === DESSERTS ===
                (object)[
                    'id' => 14, 'name' => 'Classic Halo-Halo Supreme', 'category' => 'Desserts', 'price' => 150.00,
                    'description' => 'Shaved ice layered with sweet beans, nata de coco, leche flan, ube halaya, evaporated milk, and ube ice cream.',
                    'image' => 'https://tse4.mm.bing.net/th/id/OIP.jjYDBzT9UfbdzOdynN9ckwHaHa?rs=1&pid=ImgDetMain&o=7&rm=3'
                ],
                (object)[
                    'id' => 15, 'name' => 'Velvety Leche Flan', 'category' => 'Desserts', 'price' => 95.00,
                    'description' => 'Rich, smooth, and ultra-creamy egg yolk caramel custard dessert topped with a golden sweet syrupy glaze sauce.',
                    'image' => 'https://www.bitemybun.com/wp-content/uploads/2020/08/Filipino-Leche-Flan.jpg'
                ],
                (object)[
                    'id' => 16, 'name' => 'Turon de Malacañang', 'category' => 'Desserts', 'price' => 75.00,
                    'description' => 'Deep-fried brown sugar coated spring roll wrappers stuffed with ripe saba banana slices and sweet jackfruit strip bits.',
                    'image' => 'https://tse3.mm.bing.net/th/id/OIP.tN4WWxb6DM3p3coNXqx9RgHaE8?rs=1&pid=ImgDetMain&o=7&rm=3'
                ],
                (object)[
                    'id' => 17, 'name' => 'Mango Float Slice', 'category' => 'Desserts', 'price' => 110.00,
                    'description' => 'Chilled graham cracker icebox cake layered with thick sweet condensed cream and fresh slices of sweet ripe Philippine mangoes.',
                    'image' => 'https://www.myrecipecast.com/wp-content/uploads/2025/07/no-bake-mango-float-featured-image.webp'
                ],

                // === DRINKS ===
                (object)[
                    'id' => 18, 'name' => 'Premium Samalamig', 'category' => 'Drinks', 'price' => 55.00,
                    'description' => 'Refreshing local sweet drink blend made with brown sugar syrup, gelatin cubes, tapioca pearls, and crushed ice.',
                    'image' => 'https://vineandplate.com/wp-content/uploads/2021/08/Mango-Vodka-Sour-Cocktail-Square-1024x1024.jpeg'
                ],
                (object)[
                    'id' => 19, 'name' => 'Calamansi Honey Ice Juice', 'category' => 'Drinks', 'price' => 65.00,
                    'description' => 'Freshly squeezed Philippine calamansi citrus lime juice sweetened with pure wild organic honey, served over ice rocks.',
                    'image' => 'https://completegardening.com/wp-content/uploads/2024/12/Pineapple-Mint-Cooler.jpg'
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