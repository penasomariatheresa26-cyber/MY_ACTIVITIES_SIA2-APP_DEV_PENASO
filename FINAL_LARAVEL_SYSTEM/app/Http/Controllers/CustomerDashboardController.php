<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    private function products(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Pink Rose Bouquet',
                'description' => 'A sweet bouquet of fresh pink roses wrapped beautifully for birthdays, anniversaries, and surprises.',
                'price' => 899.00,
                'image' => 'https://images.pexels.com/photos/12622593/pexels-photo-12622593.jpeg?auto=compress&cs=tinysrgb&w=900',
            ],
            [
                'id' => 2,
                'name' => 'Red Rose Love',
                'description' => 'Classic red roses arranged for romantic gifts and special celebrations.',
                'price' => 999.00,
                'image' => 'https://images.pexels.com/photos/13306278/pexels-photo-13306278.jpeg?auto=compress&cs=tinysrgb&w=900',
            ],
            [
                'id' => 3,
                'name' => 'Sunflower Bliss',
                'description' => 'Bright sunflower bouquet that brings happiness and warmth to any occasion.',
                'price' => 699.00,
                'image' => 'https://images.pexels.com/photos/35074984/pexels-photo-35074984.jpeg?auto=compress&cs=tinysrgb&w=900',
            ],
            [
                'id' => 4,
                'name' => 'Tulip Elegance',
                'description' => 'Elegant tulip arrangement for simple, classy, and heartfelt flower gifting.',
                'price' => 749.00,
                'image' => 'https://images.pexels.com/photos/15409849/pexels-photo-15409849.jpeg?auto=compress&cs=tinysrgb&w=900',
            ],
            [
                'id' => 5,
                'name' => 'White Orchid Pot',
                'description' => 'Premium orchid flower in a pot, perfect for home decor and gifts.',
                'price' => 1299.00,
                'image' => 'https://images.pexels.com/photos/34790956/pexels-photo-34790956.jpeg?auto=compress&cs=tinysrgb&w=900',
            ],
            [
                'id' => 6,
                'name' => 'Mixed Garden Bouquet',
                'description' => 'Colorful mixed flowers for birthdays, congratulations, and thank-you gifts.',
                'price' => 849.00,
                'image' => 'https://images.pexels.com/photos/13306259/pexels-photo-13306259.jpeg?auto=compress&cs=tinysrgb&w=900',
            ],
        ];
    }

    public function index(): View
    {
        $products = $this->products();
        $cart = session()->get('cart', []);
        $orders = session()->get('customer_orders', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        $deliveryFee = $subtotal > 0 ? 80.00 : 0.00;
        $total = $subtotal + $deliveryFee;

        return view('panels.customer', compact(
            'products',
            'cart',
            'orders',
            'subtotal',
            'deliveryFee',
            'total'
        ));
    }

    public function addToCart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $product = collect($this->products())->firstWhere('id', (int) $validated['product_id']);

        if (! $product) {
            return back()->with('error', 'Product not found.');
        }

        $cart = session()->get('cart', []);
        $productId = (string) $product['id'];

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += (int) $validated['qty'];
        } else {
            $cart[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'image' => $product['image'],
                'qty' => (int) $validated['qty'],
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Flower added to cart.');
    }

    public function updateCart(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session()->get('cart', []);
        $key = (string) $id;

        if (! isset($cart[$key])) {
            return back()->with('error', 'Cart item not found.');
        }

        $cart[$key]['qty'] = (int) $validated['qty'];
        session()->put('cart', $cart);

        return back()->with('success', 'Cart quantity updated.');
    }

    public function removeFromCart(int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);
        $key = (string) $id;

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Flower removed from cart.');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:gcash,cod,cash'],
        ]);

        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return back()->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        $deliveryFee = 80.00;
        $total = $subtotal + $deliveryFee;

        $paymentLabel = match ($validated['payment_method']) {
            'gcash' => 'GCash',
            'cod' => 'Cash on Delivery',
            default => 'Cash',
        };

        $orders = session()->get('customer_orders', []);

        array_unshift($orders, [
            'order_no' => 'ORD-' . now()->format('YmdHis'),
            'items' => $cart,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'total' => $total,
            'payment_method' => $paymentLabel,
            'status' => 'Pending',
            'created_at' => now()->format('M d, Y h:i A'),
        ]);

        session()->put('customer_orders', $orders);
        session()->forget('cart');

        return redirect()
            ->route('customer.panel')
            ->with('success', "Order placed successfully using {$paymentLabel}.");
    }
}