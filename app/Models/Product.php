<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'description',
        'fragrance_family',
        'image',
        'gender',
        'status',
        'notes_top',
        'notes_top_image',
        'notes_middle',
        'notes_middle_image',
        'notes_base',
        'notes_base_image',
        'gallery',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
    // App\Models\Product.php
    public function smallestVariation()
    {
        return $this->hasOne(ProductVariation::class)
            ->orderByRaw("CAST(REGEXP_REPLACE(variation_type, '[^0-9]', '') AS UNSIGNED) ASC");
    }
}
