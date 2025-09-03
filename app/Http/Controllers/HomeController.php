<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{

public function index()
{
    $products = Product::with(['brand', 'smallestVariation'])
        ->where('status', 1) // sirf active products
        ->get();

    return view('index', compact('products'));
}

}
