<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
    'order_id',
    'food_id',
    'quantity',
    'food_name',
    'food_price',
    'subtotal', // <-- Add this here

    ];

   protected $casts = [
    'food_price' => 'decimal:2',
    'subtotal'   => 'decimal:2', // <-- Add this here
];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}