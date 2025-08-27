<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $user = Auth::user(); // login user ka object mil jayega

    if ($user->role === 'admin') {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    } else {
        return redirect()->intended('/'); // yahan apna user panel route use karo
    }
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.products.create');

    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'ml' => 'required|numeric',
        'quantity' => 'required|integer',
        'real_price' => 'required|numeric',
        'discount_price' => 'nullable|numeric',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($validated);

    return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         return view('admin.products.edit');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
