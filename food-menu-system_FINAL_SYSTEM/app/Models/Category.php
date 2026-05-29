<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // If your table name is exactly "categories", Laravel finds it automatically.
    // You can specify mass-assignable attributes here:
    protected $fillable = ['name'];
}