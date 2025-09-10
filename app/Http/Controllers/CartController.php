<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
   public function viewCart() {
    return view('cart');
}

public function addToCart(Request $request, $slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    $cart = session()->get('cart', []);

    $variationId = $request->variation_id;
    $price = $request->price;
    $volume = $request->volume;
    $quantity = $request->quantity;

    $key = $slug . '-' . $variationId;

    if (isset($cart[$key])) {
        $cart[$key]['quantity'] += $quantity;
    } else {
        $cart[$key] = [
            'name' => $product->name,
            'price' => $price,
            'image' => $product->image,
            'volume' => $volume,
            'quantity' => $quantity
        ];
    }

    session()->put('cart', $cart);
    return redirect()->route('cart.view')->with('success', 'Product added to cart!');
}

public function updateQuantity(Request $request)
{
    $cart = session()->get('cart', []);
    $key = $request->slug;
    $quantity = (int) $request->quantity;

    if (isset($cart[$key])) {
        $cart[$key]['quantity'] = max(1, $quantity); // Prevent zero or negative
        session()->put('cart', $cart);

        // Recalculate subtotal for this item
        $subtotal = $cart[$key]['price'] * $cart[$key]['quantity'];

        // Recalculate total for entire cart
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'subtotal' => number_format($subtotal),
            'total' => number_format($total)
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Item not found in cart.'
    ], 404);
}

public function removeItem($key)
{
    $cart = session()->get('cart');

    if (isset($cart[$key])) {
        unset($cart[$key]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.view')->with('success', 'Item removed!');
}

public function bulkAdd(Request $request)
{
    $cart = session()->get('cart', []);

    foreach ($request->selected_products ?? [] as $slug) {
        $variationId = $request->variation_id[$slug];
        $price = $request->price[$slug];
        $volume = $request->volume[$slug];
        $quantity = $request->quantity[$slug];

        $key = $slug . '-' . $variationId;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $product = Product::where('slug', $slug)->first();
            if ($product) {
                $cart[$key] = [
                    'name' => $product->name,
                    'price' => $price,
                    'image' => $product->image,
                    'volume' => $volume,
                    'quantity' => $quantity
                ];
            }
        }
    }

    session()->put('cart', $cart);
    return redirect()->route('cart.view')->with('success', 'Selected products added to cart!');
}
}
