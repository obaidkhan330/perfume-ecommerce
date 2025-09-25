<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'phone'      => 'required',
            'address'    => 'required',
            'city'       => 'required',
            'postal'     => 'required',
            'payment_method' => 'required',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('/cart')->with('error', 'Your cart is empty.');
        }

        // Save order
        $order = Order::create([
            'user_id' => Auth::id() ?? null,
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'city'      => $request->city,
            'postal'    => $request->postal,
            'notes'     => $request->notes,
            'payment_method' => $request->payment_method,
            'total'     => $request->total,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_name' => $item['name'],
                'quantity'     => $item['quantity'],
                'price'        => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('shop')->with('success', 'Order placed successfully!');
    }
}
