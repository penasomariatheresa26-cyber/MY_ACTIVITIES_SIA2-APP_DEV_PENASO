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
                'description' => 'A lovely bouquet of fresh pink roses, perfect for birthdays, anniversaries, and sweet surprises.',
                'price' => 899.00,
                'image' => 'https://images.pexels.com/photos/12622593/pexels-photo-12622593.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'id' => 2,
                'name' => 'Red Rose Love',
                'description' => 'Classic red roses arranged beautifully for romantic gifts and special occasions.',
                'price' => 999.00,
                'image' => 'https://images.pexels.com/photos/13306278/pexels-photo-13306278.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'id' => 3,
                'name' => 'Sunflower Bliss',
                'description' => 'Bright and cheerful sunflowers that bring happiness and warmth to any celebration.',
                'price' => 699.00,
                'image' => 'https://images.pexels.com/photos/35074984/pexels-photo-35074984.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'id' => 4,
                'name' => 'Tulip Elegance',
                'description' => 'Elegant tulips wrapped in a premium paper bouquet for simple and classy gifts.',
                'price' => 749.00,
                'image' => 'https://images.pexels.com/photos/15409849/pexels-photo-15409849.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'id' => 5,
                'name' => 'White Orchid Pot',
                'description' => 'A graceful white orchid plant in a pot, perfect for home decoration and office gifts.',
                'price' => 1299.00,
                'image' => 'https://images.pexels.com/photos/34790956/pexels-photo-34790956.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'id' => 6,
                'name' => 'Mixed Garden Bouquet',
                'description' => 'A colorful mixed bouquet made with seasonal flowers for birthdays and celebrations.',
                'price' => 849.00,
                'image' => 'https://images.pexels.com/photos/13306259/pexels-photo-13306259.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'id' => 7,
                'name' => 'Purple Bloom Basket',
                'description' => 'A charming basket arrangement with purple and pink blooms for elegant gifting.',
                'price' => 1199.00,
                'image' => 'https://images.pexels.com/photos/34790955/pexels-photo-34790955.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'id' => 8,
                'name' => 'Premium Floral Gift Set',
                'description' => 'A premium flower gift set with fresh blooms, ribbon wrap, and elegant presentation.',
                'price' => 1499.00,
                'image' => 'https://images.pexels.com/photos/18004553/pexels-photo-18004553.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
        ];
    }

    public function index(): View
    {
        $products = $this->products();
        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        $deliveryFee = $subtotal > 0 ? 80.00 : 0.00;
        $total = $subtotal + $deliveryFee;

        return view('panels.customer', [
            'products' => $products,
            'cart' => $cart,
            'subtotal' => $subtotal,
            'deliveryFee' => $deliveryFee,
            'total' => $total,
        ]);
    }

    public function addToCart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $product = collect($this->products())->firstWhere('id', (int) $validated['product_id']);

        if (! $product) {
            return back()->with('error', 'Flower product not found.');
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

        return back()->with('success', 'Flower added to cart successfully.');
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

        return back()->with('success', 'Cart item updated successfully.');
    }

    public function removeFromCart(int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);
        $key = (string) $id;

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart item removed successfully.');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:gcash,cash,cod'],
        ]);

        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return back()->with('error', 'Your cart is empty.');
        }

        $paymentLabel = match ($validated['payment_method']) {
            'gcash' => 'GCash',
            'cash' => 'Cash',
            'cod' => 'Cash on Delivery',
        };

        session()->forget('cart');

        return redirect()
            ->route('customer.panel')
            ->with('success', "Order placed successfully. Payment method: {$paymentLabel}.");
    }
}