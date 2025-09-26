<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;


use App\Models\Product;
use App\Models\Tester;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $maleProducts = Product::where('gender', 'male')->latest()->get();
        $femaleProducts = Product::where('gender', 'female')->latest()->get();
       $unisexProducts = Product::where('gender', 'unisex')->latest()->get();
        $testers = Tester::with('variations', 'brand')->latest()->get();
        $brands = Brand::get();

        return view('index', compact('maleProducts', 'femaleProducts', 'unisexProducts', 'testers','brands'));
    }

public function showProducts($gender = null)
{
    if ($gender !== null && in_array($gender, ['male', 'female', 'unisex'])) {
        $Products = Product::where('gender', $gender)->latest()->get();
    } else {
        $Products = Product::latest()->get();
    }

    // dynamic counts
    $counts = [
        'male' => Product::where('gender', 'male')->count(),
        'female' => Product::where('gender', 'female')->count(),
        'unisex' => Product::where('gender', 'unisex')->count(),
    ];

    return view('shop', compact('Products', 'counts'));
}



public function maleProducts($gender = null)
{
    $query = Product::query();

    if ($gender) {
        $query->where('gender', $gender);
    } else {
        $query->where('gender', 'male'); // default male products
    }

    $Products = $query->latest()->get();

    return view('male', ['maleProducts' => $Products]);
}
public function brandProducts($brand = null)
{
    $query = Product::query();

    if ($brand) {
        $query->where('brand_id', $brand->id); // use the brand id
    } else {
        $query->where('gender', 'male'); // default male products
    }

    $maleProducts = $query->latest()->get();
    $brandName = $brand ? $brand->name : 'All Brands';

    return view('brands-products', compact('maleProducts', 'brandName'));
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
