<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // place an order
    public function store(Request $request)
    {
        // check login
        if (!Auth::check()) {
            return response()->json(['error' => 'Please login first to place order'], 401);
        }

        $request->validate([
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
            'address'    => 'required|string|max:255',
        ]);

        $order = new Order();
        $order->user_id    = Auth::id();
        $order->product_id = $request->product_id;
        $order->quantity   = $request->quantity;
        $order->address    = $request->address;
        $order->status     = 'pending';
        $order->save();

        return response()->json(['success' => 'Order placed successfully!', 'order' => $order]);
    }

    // view user orders
    public function myOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your orders');
        }

        $orders = Order::where('user_id', Auth::id())->with('product')->latest()->get();

        return view('orders.my-orders', compact('orders'));
    }
}
