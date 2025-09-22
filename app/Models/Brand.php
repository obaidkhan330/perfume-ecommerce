<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'origin_country',
        'website',
        'status',

    ];

        public function products()
    {
        return $this->hasMany(Product::class);
    }
        public function getRouteKeyName()
    {
        return 'slug'; // so Laravel uses slug instead of id
    }
}
