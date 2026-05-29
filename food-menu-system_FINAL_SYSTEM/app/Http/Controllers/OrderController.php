<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Store a newly created order in the database.
     */
    public function store(Request $request)
    {
        // 1. Get the cart session items
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart');
        }

        // 2. Calculate the total checkout amount
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 3. Create the main Order record
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'total_amount' => $total,
            'status' => 'Pending'
        ]);

        // 4. Loop through the cart items and save them to order_items table
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        // 5. Clear the shopping cart session data after a successful checkout
        session()->forget('cart');

        // 6. Redirect to a success page or back to the menu with a message
        return redirect('/menu')->with('success', 'Order placed successfully! Your order ID is #' . $order->id);
    }
}