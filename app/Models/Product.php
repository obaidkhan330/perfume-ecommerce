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
}
