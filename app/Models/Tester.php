<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tester extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'description', 'brand_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variations()
    {
        return $this->hasMany(TesterVariation::class);
    }

    public function smallestVariation()
    {
        return $this->variations()->orderBy('price', 'asc')->first();
    }
}
