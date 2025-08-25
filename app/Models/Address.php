<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Address extends Model {
    protected $fillable = ['user_id','city_id','area','postal_code','full_address','phone','is_default'];
    public function user() { return $this->belongsTo(User::class); }
    public function city() { return $this->belongsTo(City::class); }
}
