<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items')->where('user_id', Auth::id())->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function success($id)
    {
        $order = Order::with('items')->where('user_id', Auth::id())->findOrFail($id);
        return view('orders.success', compact('order'));
    }

    public function printReceipt($id)
    {
        // Find the order or throw a 404, ensuring it belongs to the logged-in user
        $order = Order::with('items.food') // Eager load items and food details
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        // Return a dedicated printer-friendly view layout
        return view('orders.receipt', compact('order'));
    }
}