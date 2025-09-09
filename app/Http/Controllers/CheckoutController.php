<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'address' => 'required',
    ]);

    $cart = session('cart', []);
    $total = $request->total;

    // Save order logic here...

    session()->forget('cart');

    return redirect()->route('shop')->with('success', 'Order placed successfully!');
}

    public function index()
    {
        return view('checkout');
    }
}
