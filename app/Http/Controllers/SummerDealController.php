<?php

namespace App\Http\Controllers;

use App\Models\SummerDeal;
use App\Models\Product;
use Illuminate\Http\Request;

class SummerDealController extends Controller
{
    public function index()
    {
        $deals = SummerDeal::with('product')->get();
        $giftPacks = SummerDeal::with('product')->where('is_gift_pack', true)->get();
        return view('summer-deals.index', compact('deals', 'giftPacks'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.summer-deals.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'real_price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'is_gift_pack' => 'nullable|boolean',
        ]);

        SummerDeal::create($request->all());

        return redirect()->route('summer-deals.index')->with('success', 'Deal Added!');
    }
}
