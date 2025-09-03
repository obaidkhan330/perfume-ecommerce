<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class AdminVariationController extends Controller
{
    //
        public function index()
    {
        $variations = ProductVariation::all();
        $products = Product::all();
        $productsVariation = ProductVariation::with('product')->get();

        return view('admin.products.variations', compact('variations', 'products','productsVariation'));
    }

       public function store(Request $request)
    {
        $request->validate([
            'product_id'     => 'required|exists:products,id',
            'variation_type' => 'required|string|max:255',
            'stock'          => 'required|integer|min:0',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku'            => 'required|string|max:100|unique:product_variations,sku',
        ]);

        ProductVariation::create($request->all());

        return back()->with('success', 'Product variation added successfully.');
    }

        public function update(Request $request, $id)
    {
        $variation = ProductVariation::findOrFail($id);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variation_type' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|max:255|unique:product_variations,sku,' . $variation->id,
        ]);

        $variation->update($request->all());

        return redirect()->back()->with('success', 'Variation updated successfully!');
    }

    public function destroy($id)
    {
        $variation = ProductVariation::findOrFail($id);
        $variation->delete();

        return redirect()->back()->with('success', 'Variation deleted successfully!');
    }
}
