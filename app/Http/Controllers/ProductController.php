<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SummerDeal;
use Illuminate\Http\Request;

class ProductController extends Controller
{
 public function details($slug, Request $request)
{
    $product = Product::where('slug', $slug)
        ->with(['variations', 'brand'])
        ->firstOrFail();

    // Check if product has a summer deal / gift pack
    $deal = SummerDeal::where('product_id', $product->id)->first();

    if ($deal) {
        // Summer deal / gift pack prices override
        $product->real_price = floatval($deal->real_price);
        $product->discount_price = floatval($deal->discount_price);
        $product->discount_percentage = $deal->discount_percentage ?? ($deal->real_price ? round((($deal->real_price - $deal->discount_price)/$deal->real_price)*100) : 0);
        $product->gallery_override = $deal->gallery_image ? [ $deal->gallery_image ] : null;
    } else {
        // No deal → fallback to variations
        $variation = $product->variations->sortBy('price')->first();
        if ($variation) {
            $product->real_price = floatval($variation->price);
            $product->discount_price = $variation->discount_price ? floatval($variation->discount_price) : null;
            $product->discount_percentage = $variation->discount_price
                ? round((($variation->price - $variation->discount_price)/$variation->price)*100)
                : 0;
        } else {
            $product->real_price = floatval($product->price);
            $product->discount_price = null;
            $product->discount_percentage = 0;
        }
        $product->gallery_override = null;
    }

    return view('details', compact('product'));
}


}
