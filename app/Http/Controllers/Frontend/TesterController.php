<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tester;

class TesterController extends Controller
{
    // list all testers
   public function index()
    {
        $testers = Tester::with('variations', 'brand')->latest()->get();
        return view('testers.index', compact('testers'));
    }

    public function show($slug)
    {
        $tester = Tester::where('slug', $slug)->with('variations', 'brand')->firstOrFail();
        return view('testers.show', compact('tester'));
    }
}
