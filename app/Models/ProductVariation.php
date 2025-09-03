<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    // Product variation attributes
    protected $fillable = [
        'product_id',
        'variation_type',
        'stock',
        'price',
        'discount_price',
        'sku',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // App\Models\Product.php


}
