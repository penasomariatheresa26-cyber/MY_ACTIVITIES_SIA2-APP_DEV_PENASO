<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Fixed the typo here from "equest"
use App\Models\MenuItem;

class CartController extends Controller
{
    /**
     * Display the shopping cart page.
     */
    public function index()
    {
        // Get cart items from session, default to empty array if session doesn't exist
        $cart = session()->get('cart', []);

        return view('cart', compact('cart'));
    }

    /**
     * Add a menu item to the shopping cart session.
     */
    public function add(Request $request)
    {
        // Find the item or fail with a 404 page if it doesn't exist
        $item = MenuItem::findOrFail($request->menu_item_id);

        $cart = session()->get('cart', []);

        // If item already exists in cart, just increment the quantity
        if (isset($cart[$item->id])) {
            $cart[$item->id]['quantity']++;
        } else {
            // Otherwise, add the item as a new entry in the cart array
            $cart[$item->id] = [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1,
                'image' => $item->image
            ];
        }

        // Save the updated cart array back into the session
        session()->put('cart', $cart);

        return redirect('/cart');
    }
}