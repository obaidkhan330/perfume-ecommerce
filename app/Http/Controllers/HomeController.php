<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $maleProducts = Product::where('gender', 'male')->latest()->get();
        $femaleProducts = Product::where('gender', 'female')->latest()->get();
       $unisexProducts = Product::where('gender', 'unisex')->latest()->get();

        return view('index', compact('maleProducts', 'femaleProducts', 'unisexProducts'));
    }

public function showProducts($gender = null)
{
    if ($gender) {
        $Products = Product::where('gender', $gender)->latest()->get();
    } else {
        $Products = Product::latest()->get(); // sab products
    }

    return view('shop', compact('Products'));
}




    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->with('brand')->firstOrFail();

        $similarItems = Product::where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('fragrance_family', $product->fragrance_family)
                    ->orWhere('brand_id', $product->brand_id);
            })
            ->take(4)->get();

        $topPerfumes = Product::where('status', true)->inRandomOrder()->take(4)->get();

        return view('details', compact('product', 'similarItems', 'topPerfumes'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $similarItems = Product::where('slug', '!=', $product->slug)
            ->where('category_slug', $product->category_slug)           //   assuming category_slug is stored in product table
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('details', compact('product', 'similarItems'));
    }



}
