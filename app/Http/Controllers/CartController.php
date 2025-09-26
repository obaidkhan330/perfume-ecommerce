<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tester;
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

    $price    = (float) $request->price;
    $volume   = $request->volume;
    $quantity = (int) $request->quantity;

    if (isset($cart[$slug])) {
        $cart[$slug]['quantity'] += $quantity;
    } else {
        $cart[$slug] = [
            'slug'     => $slug,
            'name'     => $product->name,
            'price'    => $price,
            'image'    => $product->image,
            'volume'   => $volume,
            'quantity' => $quantity
        ];
    }



    session()->put('cart', $cart);

    return back()->with('success', 'Product added to cart successfully!');
}
public function updateQuantity(Request $request)
{
    $cart = session()->get('cart', []);
    $key = $request->slug;
    $quantity = (int) $request->quantity;

    if (isset($cart[$key])) {
        $cart[$key]['quantity'] = max(1, $quantity);
        session()->put('cart', $cart);

        $subtotal = $cart[$key]['price'] * $cart[$key]['quantity'];

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
    $selected = $request->input('selected_products', []);

    if (empty($selected)) {
        return back()->with('error', 'Please select the product');
    }

    $cart = session()->get('cart', []);

    foreach ($selected as $slug) {
        $product = Product::where('slug', $slug)->first();
        if (!$product) continue;

        $variationId = $request->variation_id[$slug] ?? null;
        $price       = $request->price[$slug] ?? 0;
        $volume      = $request->volume[$slug] ?? '';
        $quantity    = $request->quantity[$slug] ?? 1;

        if ($variationId) {
            if (isset($cart[$slug])) {
                $cart[$slug]['quantity'] += $quantity;
            } else {
                $cart[$slug] = [
                    'slug'     => $slug,
                    'name'     => $product->name,
                    'price'    => (float) $price,
                    'image'    => $product->image,
                    'volume'   => $volume,
                    'quantity' => (int) $quantity,
                ];
            }
        }
    }

    session()->put('cart', $cart);

    // ✅ Agar buy select kiya to direct checkout
    if ($request->action === 'buy') {
        return redirect()->route('checkout')
            ->with('success', 'Selected products added. Proceed to checkout.');
    }

    // ✅ Add to cart case
    return back()->with('success', 'Selected products added to cart.');
}





// tester

public function addTester(Request $request, $id)
{
    $tester = Tester::with('variations')->findOrFail($id);
    $variation = $tester->variations()->findOrFail($request->variation_id);

    $cart = session()->get('cart', []);

    $cart['tester_'.$variation->id] = [
        'name' => $tester->name . ' (' . $variation->pack_size . ')',
        'quantity' => $request->quantity,
        'price' => $variation->discount_price ?? $variation->price,
        'image' => $tester->image,
    ];

    session()->put('cart', $cart);

    return back()->with('success', 'Tester added to cart!');
}
public function buyNow(Request $request, $slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();

    $cart = session()->get('cart', []);

    $price    = (float) $request->price;
    $volume   = $request->volume;
    $quantity = (int) $request->quantity;

    // ✅ slug ko hi unique key banaya
    if (isset($cart[$slug])) {
        $cart[$slug]['quantity'] += $quantity;
    } else {
        $cart[$slug] = [
            'slug'     => $slug,
            'name'     => $product->name,
            'price'    => $price,
            'image'    => $product->image,
            'volume'   => $volume,
            'quantity' => $quantity
        ];
    }

    session()->put('cart', $cart);

    // ✅ direct checkout par redirect
    return redirect()->route('checkout')
        ->with('success', 'Product added. Proceed to checkout.');

        if ($request->has('deal_id')) {
    $deal = \App\Models\AdminSummerDeal::find($request->deal_id);
    if ($deal) {
        $price = $deal->discount_price ?? $deal->real_price;
    }
} else {
    $price = $request->price;
}

}


}

