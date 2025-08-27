<?php

namespace App\Http\Controllers;
 use App\Models\Product;

use Illuminate\Http\Request;

class ShopController extends Controller
{

public function index()
{
    $products = Product::all(); // Ya paginate bhi kar sakta hai
    return view('shop', compact('products'));
}

}
