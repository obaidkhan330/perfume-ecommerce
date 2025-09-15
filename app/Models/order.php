<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'postal',
        'notes',
        'payment_method',
        'total',
        'status',
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
