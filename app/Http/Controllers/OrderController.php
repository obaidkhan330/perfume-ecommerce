<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

      public function index()
    {
        $orders = Order::with('items')->latest()->get();
        return view('admin.orders', compact('orders'));
    }
    // place an order
    public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please login first to place an order');
    }

    $request->validate([
        'first_name' => 'required|string|max:100',
        'last_name'  => 'required|string|max:100',
        'email'      => 'required|email',
        'phone'      => 'required|string|max:20',
        'address'    => 'required|string|max:255',
        'city'       => 'required|string|max:100',
        'postal'     => 'required|string|max:20',
        'notes'      => 'nullable|string|max:500',
        'total'      => 'required|numeric',
    ]);

    // Create new order
    $order = Order::create([
        'user_id'       => Auth::id(),
        'first_name'    => $request->first_name,
        'last_name'     => $request->last_name,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'address'       => $request->address,
        'city'          => $request->city,
        'postal'        => $request->postal,
        'notes'         => $request->notes,
        'payment_method'=> 'cod',
        'total'         => $request->total,
        'status'        => 'pending',
    ]);

    // Save order items from cart
    $cart = session('cart', []);
    foreach ($cart as $productId => $item) {
        $order->items()->create([
            'product_name' => $item['name'],
            'quantity'     => $item['quantity'],
            'price'        => $item['price'],
        ]);
    }

    // Clear cart
    session()->forget('cart');

    return redirect()->route('orders.my')->with('success', 'Order placed successfully!');
}

    // view user orders
   public function myOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your orders');
        }

        $orders = Order::where('user_id', Auth::id())
                        ->with('items')
                        ->latest()
                        ->get();

        return view('my-orders', compact('orders'));
    }


    // app/Http/Controllers/OrderController.php

public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return back()->with('success', 'Order status updated successfully.');
}

public function destroy($id)
{
    $order = Order::findOrFail($id);
    $order->delete();

    return back()->with('success', 'Order deleted successfully.');
}
}
