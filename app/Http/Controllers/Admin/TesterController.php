<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tester;
use App\Models\TesterVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TesterController extends Controller
{
    public function index()
    {
        $testers = Tester::with('variations')->latest()->get();
        return view('admin.testers.index', compact('testers'));
    }

    public function create()
    {
        return view('admin.testers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image',
        ]);

        $path = $request->file('image')?->store('testers', 'public');

        $tester = Tester::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'brand_id'    => $request->brand_id,
            'image'       => $path,
        ]);

        // Variations insert
        $variations = [
            ['pack_size' => '1 Tester', 'price' => $request->price_1, 'discount_price' => $request->discount_1],
            ['pack_size' => '3 Testers', 'price' => $request->price_3, 'discount_price' => $request->discount_3],
            ['pack_size' => '5 Testers', 'price' => $request->price_5, 'discount_price' => $request->discount_5],
        ];

        foreach ($variations as $v) {
            if ($v['price']) {
                $tester->variations()->create($v);
            }
        }

        return redirect()->route('admin.testers.index')->with('success', 'Tester added successfully!');
    }

    public function show($id)
    {
        $tester = Tester::with('variations')->findOrFail($id);
        return view('admin.testers.show', compact('tester'));
    }

    public function edit($id)
    {
        $tester = Tester::with('variations')->findOrFail($id);
        return view('admin.testers.edit', compact('tester'));
    }

    public function update(Request $request, $id)
    {
        $tester = Tester::with('variations')->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image',
        ]);

        $path = $tester->image;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('testers', 'public');
        }

        $tester->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'brand_id'    => $request->brand_id,
            'image'       => $path,
        ]);

        // Update variations
        if ($request->variation_price) {
            foreach ($request->variation_price as $varId => $price) {
                $variation = TesterVariation::find($varId);
                if ($variation) {
                    $variation->update([
                        'price'          => $price,
                        'discount_price' => $request->variation_discount[$varId] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.testers.index')->with('success', 'Tester updated successfully!');
    }

    public function destroy($id)
    {
        $tester = Tester::findOrFail($id);
        $tester->delete();
        return redirect()->route('admin.testers.index')->with('success', 'Tester deleted successfully!');
    }
}
