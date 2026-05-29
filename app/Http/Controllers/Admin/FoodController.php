<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    public function index(Request $request)
    {
        $query = Food::query();
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $foods = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Food::distinct()->pluck('category');
        return view('admin.foods.index', compact('foods', 'categories'));
    }
    public function create()
    {
        $categories = Food::distinct()->pluck('category');
        return view('admin.foods.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('foods', 'public');
        }
        $validated['is_available'] = $request->has('is_available');
        Food::create($validated);
        return redirect()->route('admin.foods.index')
            ->with('success', 'Food item created successfully!');
    }
    public function edit(Food $food)
    {
        $categories = Food::distinct()->pluck('category');
        return view('admin.foods.edit', compact('food', 'categories'));
    }
    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
        ]);
        if ($request->hasFile('image')) {
            if ($food->image) {
                Storage::disk('public')->delete($food->image);
            }
            $validated['image'] = $request->file('image')->store('foods', 'public');
        }
        $validated['is_available'] = $request->has('is_available');
        $food->update($validated);
        return redirect()->route('admin.foods.index')
            ->with('success', 'Food item updated successfully!');
    }
    public function destroy(Food $food)
    {
        if ($food->image) {
            Storage::disk('public')->delete($food->image);
        }
        $food->delete();
        return redirect()->route('admin.foods.index')
            ->with('success', 'Food item deleted successfully!');
    }
}