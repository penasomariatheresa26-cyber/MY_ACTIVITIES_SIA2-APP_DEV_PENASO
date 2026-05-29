<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $cartItems = Cart::with('food')
            ->where('user_id', $user->id)
            ->get();

        $subtotal = $cartItems->sum(fn($item) => $item->food->price * $item->quantity);
        $deliveryFee = 50;
        $total = $subtotal + $deliveryFee;

        return view('checkout', compact(
            'user',
            'cartItems',
            'subtotal',
            'deliveryFee',
            'total'
        ));
    }

    public function process(Request $request)
    {
        $user = auth()->user();

        $cartItems = Cart::with('food')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty!');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->food->price * $item->quantity);
        $deliveryFee = 50;
        $total = $subtotal + $deliveryFee;

        DB::transaction(function () use ($request, $user, $cartItems, $total) {

            $order = Order::create([
                'user_id' => $user->id,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'total_amount' => $total,
                'notes' => $request->notes,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'food_id'    => $item->food_id,
                    'quantity'   => $item->quantity,
                    'food_name'  => $item->food->name,
                    'food_price' => $item->food->price,
                    'subtotal'   => $item->food->price * $item->quantity,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();
        }); // <-- Fixed: Added the missing curly brace here

        return redirect()->route('orders')
            ->with('success', 'Order placed successfully!');
    }
}