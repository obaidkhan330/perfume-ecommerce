<?php

namespace App\Http\Controllers;

use App\Models\AdminSummerDeal;
use App\Models\Product;
use App\Models\SummerDeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSummerDealController extends Controller
{
    public function index()
    {
        $deals = AdminSummerDeal::with('product')->get();
        $products = Product::all();
        return view('admin.summer-deals.index', compact('deals', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'real_price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'gift_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_gift_pack' => 'nullable|boolean'
        ]);

        $data = $request->only(['product_id','real_price','discount_price']);
        $data['is_gift_pack'] = $request->has('is_gift_pack');

        if ($request->hasFile('gift_image')) {
            $data['gift_image'] = $request->file('gift_image')->store('gift_packs', 'public');
        }

        if ($request->hasFile('gallery_image')) {
            $data['gallery_image'] = $request->file('gallery_image')->store('gallery', 'public');
        }

        $deal = AdminSummerDeal::create($data);

        // Sync with user side summer_deals table
        SummerDeal::updateOrCreate(
            ['product_id' => $deal->product_id],
            $deal->only(['real_price','discount_price','is_gift_pack','gift_image','gallery_image'])
        );

        return redirect()->back()->with('success', 'Summer deal added successfully.');
    }

   public function update(Request $request, $id)
{
    $deal = AdminSummerDeal::findOrFail($id);

    $request->validate([
        'real_price' => 'required|numeric',
        'discount_price' => 'required|numeric',
        'gift_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gallery_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_gift_pack' => 'nullable|boolean'
    ]);

    $deal->real_price = $request->real_price;
    $deal->discount_price = $request->discount_price;
    $deal->is_gift_pack = $request->has('is_gift_pack');

    if ($request->hasFile('gift_image')) {
        if ($deal->gift_image) Storage::disk('public')->delete($deal->gift_image);
        $deal->gift_image = $request->file('gift_image')->store('gift_packs', 'public');
    }

    if ($request->hasFile('gallery_image')) {
        if ($deal->gallery_image) Storage::disk('public')->delete($deal->gallery_image);
        $deal->gallery_image = $request->file('gallery_image')->store('gallery', 'public');
    }

    $deal->save();

    // Sync with user side summer_deals table
    SummerDeal::updateOrCreate(
        ['product_id' => $deal->product_id],
        [
            'real_price' => $deal->real_price,
            'discount_price' => $deal->discount_price,
            'is_gift_pack' => $deal->is_gift_pack,
            'gift_image' => $deal->gift_image,
            'gallery_image' => $deal->gallery_image
        ]
    );

    return redirect()->back()->with('success', 'Summer deal updated successfully.');
}

    public function destroy($id)
    {
        $deal = AdminSummerDeal::findOrFail($id);

        if ($deal->gift_image) Storage::disk('public')->delete($deal->gift_image);
        if ($deal->gallery_image) Storage::disk('public')->delete($deal->gallery_image);

        $deal->delete();

        SummerDeal::where('product_id', $deal->product_id)->delete();

        return redirect()->back()->with('success', 'Summer deal deleted successfully.');
    }
}
