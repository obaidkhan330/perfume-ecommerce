<?php
namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->with('product.variations')->get();
        return view('wishlist.index', compact('wishlists'));
    }

    public function store($productId)
    {
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        // Return JSON for AJAX
        return response()->json([
            'status' => 'added',
            'count' => Auth::user()->wishlists()->count(),
        ]);
    }

    public function destroy($productId)
    {
        Wishlist::where('product_id', $productId)->where('user_id', Auth::id())->delete();

        return response()->json([
            'status' => 'removed',
            'count' => Auth::user()->wishlists()->count(),
        ]);
    }
}



