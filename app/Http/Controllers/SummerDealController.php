<?php

namespace App\Http\Controllers;

use App\Models\SummerDeal;
use Illuminate\Http\Request;

class SummerDealController extends Controller
{
    public function index()
    {
        $deals = SummerDeal::with('product')->where('is_gift_pack', false)->get();
        $giftPacks = SummerDeal::with('product')->where('is_gift_pack', true)->get();

        return view('summer-deals.index', compact('deals', 'giftPacks'));
    }
}
