<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
        'is_available',
    ];
    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}