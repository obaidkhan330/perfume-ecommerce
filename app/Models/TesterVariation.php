<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TesterVariation extends Model
{
    protected $fillable = ['tester_id', 'pack_size', 'price', 'discount_price'];

    public function tester()
    {
        return $this->belongsTo(Tester::class);
    }
}
