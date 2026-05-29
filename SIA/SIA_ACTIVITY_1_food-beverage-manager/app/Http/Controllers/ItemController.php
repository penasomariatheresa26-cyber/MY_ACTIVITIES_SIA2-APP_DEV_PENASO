<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $items = [
        ['id' => 1, 'name' => 'Green Smoothie', 'description' => 'Healthy spinach & kale smoothie', 'category' => 'Beverage', 'price' => 150],
        ['id' => 2, 'name' => 'Avocado Toast', 'description' => 'Whole grain toast with avocado', 'category' => 'Snack', 'price' => 120],
        ['id' => 3, 'name' => 'Matcha Latte', 'description' => 'Creamy matcha milk latte', 'category' => 'Beverage', 'price' => 130],
        ['id' => 4, 'name' => 'Veggie Wrap', 'description' => 'Fresh vegetables wrapped in tortilla', 'category' => 'Meal', 'price' => 180],
        ['id' => 5, 'name' => 'Cucumber Salad', 'description' => 'Refreshing cucumber and mint salad', 'category' => 'Salad', 'price' => 100],
        ['id' => 6, 'name' => 'Berry Smoothie', 'description' => 'Mixed berries with yogurt', 'category' => 'Beverage', 'price' => 140],
        ['id' => 7, 'name' => 'Grilled Sandwich', 'description' => 'Cheese and tomato grilled sandwich', 'category' => 'Snack', 'price' => 110],
        ['id' => 8, 'name' => 'Quinoa Salad', 'description' => 'Quinoa with mixed greens and nuts', 'category' => 'Salad', 'price' => 160],
        ['id' => 9, 'name' => 'Herbal Tea', 'description' => 'Refreshing herbal blend tea', 'category' => 'Beverage', 'price' => 90],
        ['id' => 10, 'name' => 'Chicken Wrap', 'description' => 'Grilled chicken with vegetables', 'category' => 'Meal', 'price' => 200],
    ];

    public function index(Request $request)
    {
        $category = $request->query('category', 'All');

        if ($category === 'All') {
            $items = $this->items;
        } else {
            $items = array_filter($this->items, fn($item) => $item['category'] === $category);
        }

        $categories = ['All', 'Beverage', 'Meal', 'Snack', 'Salad'];

        return view('items.index', compact('items', 'categories', 'category'));
    }

    public function show($id)
    {
        $item = collect($this->items)->firstWhere('id', $id);
        if (!$item) abort(404);
        return view('items.show', compact('item'));
    }
}