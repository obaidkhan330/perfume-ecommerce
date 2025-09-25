<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SummerDeal extends Model
{
    protected $fillable = [
        'product_id',
        'real_price',
        'discount_price',
        'is_gift_pack',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->real_price > 0) {
            return round((($this->real_price - $this->discount_price) / $this->real_price) * 100);
        }
        return 0;
    }
}
