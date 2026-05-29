<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * View active cart list with dynamic total pricing calculations
     */
    public function index()
    {
        $cartItems = Cart::with('food')
            ->where('user_id', Auth::id())
            ->get();
        
        $subtotal = $cartItems->sum(function ($item) {
            return $item->food ? (float)$item->food->price * (int)$item->quantity : 0;
        });
        
        $deliveryFee = 50;
        $total = $subtotal + $deliveryFee;
        
        return view('cart', compact('cartItems', 'subtotal', 'deliveryFee', 'total'));
    }

    /**
     * Add items to cart with unlimited quantity permissions
     */
    public function add(Request $request)
    {
        // Automatically inject the item if the database row is empty
        $foodExists = Food::find($request->food_id);

        if (!$foodExists) {
            $mockMenu = $this->getMockMenuData();

            if (array_key_exists($request->food_id, $mockMenu)) {
                $itemInfo = $mockMenu[$request->food_id];
                Food::create([
                    'id'          => $request->food_id,
                    'name'        => $itemInfo['name'],
                    'category'    => $itemInfo['category'],
                    'price'       => $itemInfo['price'],
                    'description' => $itemInfo['description'],
                    'image'       => $itemInfo['image']
                ]);
            }
        }

        $request->validate([
            'food_id' => 'required|exists:foods,id',
        ]);

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('food_id', $request->food_id)
            ->first();

        if ($existingCart) {
            $existingCart->increment('quantity');
        } else {
            Cart::create([
                'user_id'  => Auth::id(),
                'food_id'  => $request->food_id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Added to cart!');
    }

    /**
     * Update quantity values with NO maximum ceiling cap
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1', 
        ]);

        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cart updated!');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();
        return back()->with('success', 'Removed from cart.');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Cart cleared!');
    }

    /**
     * Complete Menu Mock Repository Array Data
     */
    private function getMockMenuData()
    {
        return [
            1 => ['name' => 'Pork Adobo Elegante', 'category' => 'Rice Meals', 'price' => 245.00, 'description' => 'Tender pork belly braised slowly in a rich blend of soy sauce and vinegar.', 'image' => 'https://images.pexels.com/photos/15015354/pexels-photo-15015354/free-photo-of-braised-meat-served-in-a-bowl.jpeg?auto=compress&cs=tinysrgb&w=500'],
            2 => ['name' => 'Beef Kaldereta Supreme', 'category' => 'Rice Meals', 'price' => 320.00, 'description' => 'Rich beef stew cooked in savory tomato sauce and cheese over rice.', 'image' => 'https://images.pexels.com/photos/20125585/pexels-photo-20125585/free-photo-of-a-bowl-of-beef-stew-with-vegetables.jpeg?auto=compress&cs=tinysrgb&w=500'],
            3 => ['name' => 'Classic Chicken Inasal', 'category' => 'Rice Meals', 'price' => 195.00, 'description' => 'Lemongrass and calamansi marinated grilled chicken quarter.', 'image' => 'https://images.pexels.com/photos/2232433/pexels-photo-2232433.jpeg?auto=compress&cs=tinysrgb&w=500'],
            4 => ['name' => 'Crispy Lechon Kawali', 'category' => 'Rice Meals', 'price' => 260.00, 'description' => 'Deep-fried pork belly boiled until tender and fried until golden crispy.', 'image' => 'https://images.pexels.com/photos/9228527/pexels-photo-9228527.jpeg?auto=compress&cs=tinysrgb&w=500'],
            5 => ['name' => 'Garlic Beef Tapa (Tapsilog)', 'category' => 'Rice Meals', 'price' => 165.00, 'description' => 'Cured sweet-salty garlic beef strips served with garlic fried rice and egg.', 'image' => 'https://images.pexels.com/photos/22813136/pexels-photo-22813136/free-photo-of-delicious-breakfast-dish.jpeg?auto=compress&cs=tinysrgb&w=500'],
            6 => ['name' => 'Sizzling Pork Sisig', 'category' => 'Sizzling', 'price' => 280.00, 'description' => 'Finely chopped crispy pork seasoned with calamansi and green chilies.', 'image' => 'https://images.pexels.com/photos/18915732/pexels-photo-18915732/free-photo-of-meat-dish-served-on-cast-iron-skillet.jpeg?auto=compress&cs=tinysrgb&w=500'],
            7 => ['name' => 'Sizzling Siga Gambas', 'category' => 'Sizzling', 'price' => 295.00, 'description' => 'Plump shrimp sautéed in a spicy, garlicky tomato sauce with bell peppers.', 'image' => 'https://images.pexels.com/photos/8993444/pexels-photo-8993444.jpeg?auto=compress&cs=tinysrgb&w=500'],
            8 => ['name' => 'Sizzling Beef Pepper Rice', 'category' => 'Sizzling', 'price' => 240.00, 'description' => 'Thinly sliced premium beef strips with sweet corn, butter, and black pepper.', 'image' => 'https://images.pexels.com/photos/7625056/pexels-photo-7625056.jpeg?auto=compress&cs=tinysrgb&w=500'],
            9 => ['name' => 'Sinigang na Baboy', 'category' => 'Soups', 'price' => 295.00, 'description' => 'Comforting sour tamarind broth loaded with tender pork ribs and vegetables.', 'image' => 'https://images.pexels.com/photos/12481161/pexels-photo-12481161.jpeg?auto=compress&cs=tinysrgb&w=500'],
            10 => ['name' => 'Hearty Bulalo Supreme', 'category' => 'Soups', 'price' => 450.00, 'description' => 'Light flavored soup made by cooking beef shanks and bone marrow.', 'image' => 'https://images.pexels.com/photos/6999534/pexels-photo-6999534.jpeg?auto=compress&cs=tinysrgb&w=500'],
            11 => ['name' => 'Creamy Chicken Sopas', 'category' => 'Soups', 'price' => 135.00, 'description' => 'Classic Filipino macaroni soup cooked in milk broth with chicken.', 'image' => 'https://images.pexels.com/photos/1435868/pexels-photo-1435868.jpeg?auto=compress&cs=tinysrgb&w=500'],
            12 => ['name' => 'Pancit Bihon Guisado', 'category' => 'Noodles', 'price' => 180.00, 'description' => 'Stir-fried thin rice noodles tossed with chicken and garden vegetables.', 'image' => 'https://images.pexels.com/photos/10540455/pexels-photo-10540455.jpeg?auto=compress&cs=tinysrgb&w=500'],
            13 => ['name' => 'Sweet Style Pancit Palabok', 'category' => 'Noodles', 'price' => 190.00, 'description' => 'Rice noodles drenched in a rich, savory golden shrimp sauce layout.', 'image' => 'https://images.pexels.com/photos/8448748/pexels-photo-8448748.jpeg?auto=compress&cs=tinysrgb&w=500'],
            14 => ['name' => 'Classic Halo-Halo Supreme', 'category' => 'Desserts', 'price' => 150.00, 'description' => 'Shaved ice layered with sweet beans, leche flan, and ube ice cream.', 'image' => 'https://images.pexels.com/photos/9211330/pexels-photo-9211330.jpeg?auto=compress&cs=tinysrgb&w=500'],
            15 => ['name' => 'Velvety Leche Flan', 'category' => 'Desserts', 'price' => 95.00, 'description' => 'Rich, smooth, and ultra-creamy egg yolk caramel custard dessert.', 'image' => 'https://images.pexels.com/photos/15900139/pexels-photo-15900139/free-photo-of-close-up-of-pudding.jpeg?auto=compress&cs=tinysrgb&w=500'],
            16 => ['name' => 'Turon de Malacañang', 'category' => 'Desserts', 'price' => 75.00, 'description' => 'Deep-fried sugar coated spring rolls stuffed with ripe saba banana.', 'image' => 'https://images.pexels.com/photos/10350123/pexels-photo-10350123.jpeg?auto=compress&cs=tinysrgb&w=500'],
            17 => ['name' => 'Mango Float Slice', 'category' => 'Desserts', 'price' => 110.00, 'description' => 'Chilled graham cracker icebox cake layered with fresh Philippine mangoes.', 'image' => 'https://images.pexels.com/photos/1028714/pexels-photo-1028714.jpeg?auto=compress&cs=tinysrgb&w=500'],
            18 => ['name' => 'Premium Samalamig', 'category' => 'Drinks', 'price' => 55.00, 'description' => 'Refreshing local sweet drink blend made with brown sugar and sago pearls.', 'image' => 'https://images.pexels.com/photos/1233319/pexels-photo-1233319.jpeg?auto=compress&cs=tinysrgb&w=500'],
            19 => ['name' => 'Calamansi Honey Ice Juice', 'category' => 'Drinks', 'price' => 65.00, 'description' => 'Freshly squeezed Philippine calamansi citrus lime juice with pure honey.', 'image' => 'https://images.pexels.com/photos/11940304/pexels-photo-11940304.jpeg?auto=compress&cs=tinysrgb&w=500'],
            20 => ['name' => 'Creamy Avocado Shake', 'category' => 'Drinks', 'price' => 90.00, 'description' => 'Blended fresh ripe avocado fruit meat mixed with condensed milk.', 'image' => 'https://images.pexels.com/photos/3625372/pexels-photo-3625372.jpeg?auto=compress&cs=tinysrgb&w=500'],
        ];
    }
}