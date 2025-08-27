<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'ml', 'quantity', 'real_price', 'discount_price', 'image'];
}
