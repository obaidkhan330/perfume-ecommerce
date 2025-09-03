<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // login user ka object mil jayega

        if ($user->role === 'admin') {
            $brands = Brand::all();
        $products = Product::with('brand')->get();
        $fragranceFamilies = Product::pluck('fragrance_family')->unique();


            return view('admin.products.index', compact('products', 'brands','fragranceFamilies'));
        } else {
            return redirect()->intended('/'); // yahan apna user panel route use karo
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255|unique:brands,name',
            'slug'           => 'nullable|string|max:255|unique:brands,slug',
            'description'    => 'nullable|string',
            'origin_country' => 'nullable|string|max:100',
            'website'        => 'nullable|url|max:255',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:11024',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
        }
        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        Brand::create([
            'name'           => $request->name,
            'slug'           => $slug,
            'description'    => $request->description,
            'origin_country' => $request->origin_country,
            'website'        => $request->website,
            'logo'           => $logoPath,
            'status'         => $request->has('status'),
        ]);

        return redirect()->back()->with('success', 'Brand added successfully!');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'           => 'required|string|max:255|unique:brands,name,' . $id,
            'slug'           => 'nullable|string|max:255|unique:brands,slug,' . $id,
            'description'    => 'nullable|string',
            'origin_country' => 'nullable|string|max:100',
            'website'        => 'nullable|url|max:255',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $brand->description = $request->description;
        $brand->origin_country = $request->origin_country;
        $brand->website = $request->website;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $brand->logo = $request->file('logo')->store('brands', 'public');
        }

        $brand->status = $request->has('status');
        $brand->save();

        return redirect()->back()->with('success', 'Brand updated successfully!');
    }


    public function create()
    {
        return view('admin.products.create');
    }



    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        // Delete logo if exists
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }
        $brand->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully!');
    }

    public function storeProduct(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'fragrance_family' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:11024',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:11024',
            'notes_top_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'notes_middle_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'notes_base_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // ✅ Handle Main Image
        $mainImagePath = null;
        if ($request->hasFile('image')) {
            $mainImagePath = $request->file('image')->store('uploads/products', 'public');
        }

        // ✅ Handle Gallery (Multiple)
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryPaths[] = $galleryImage->store('uploads/products/gallery', 'public');
            }
        }

        // ✅ Handle Notes Images
        $notesTopImg = $request->hasFile('notes_top_image')
            ? $request->file('notes_top_image')->store('uploads/products/notes', 'public')
            : null;

        $notesMiddleImg = $request->hasFile('notes_middle_image')
            ? $request->file('notes_middle_image')->store('uploads/products/notes', 'public')
            : null;

        $notesBaseImg = $request->hasFile('notes_base_image')
            ? $request->file('notes_base_image')->store('uploads/products/notes', 'public')
            : null;

        // ✅ Create Product
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'brand_id' => $request->brand_id,
            'description' => $request->description,
            'fragrance_family' => $request->fragrance_family,
            'gender' => $request->gender,
            'image' => $mainImagePath,
            'status' => $request->has('status'),
            'notes_top' => $request->notes_top,
            'notes_top_image' => $notesTopImg,
            'notes_middle' => $request->notes_middle,
            'notes_middle_image' => $notesMiddleImg,
            'notes_base' => $request->notes_base,
            'notes_base_image' => $notesBaseImg,
            'gallery' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }






    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id); // fetch the product by ID

        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'notes_top_image' => 'nullable|image|max:2048',
            'notes_middle_image' => 'nullable|image|max:2048',
            'notes_base_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'name',
            'brand_id',
            'description',
            'fragrance_family',
            'gender',
            'notes_top',
            'notes_middle',
            'notes_base',
            'meta_title',
            'meta_keywords',
            'meta_description'
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->has('status');

        // Main Image
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Notes Images
        if ($request->hasFile('notes_top_image')) {
            if ($product->notes_top_image) {
                Storage::disk('public')->delete($product->notes_top_image);
            }
            $data['notes_top_image'] = $request->file('notes_top_image')->store('products/notes', 'public');
        }
        if ($request->hasFile('notes_middle_image')) {
            if ($product->notes_middle_image) {
                Storage::disk('public')->delete($product->notes_middle_image);
            }
            $data['notes_middle_image'] = $request->file('notes_middle_image')->store('products/notes', 'public');
        }
        if ($request->hasFile('notes_base_image')) {
            if ($product->notes_base_image) {
                Storage::disk('public')->delete($product->notes_base_image);
            }
            $data['notes_base_image'] = $request->file('notes_base_image')->store('products/notes', 'public');
        }

        // Gallery Images
        if ($request->hasFile('gallery')) {
            $oldGallery = json_decode($product->gallery, true);
            if ($oldGallery) {
                foreach ($oldGallery as $img) {
                    Storage::disk('public')->delete($img);
                }
            }
            $galleryFiles = [];
            foreach ($request->file('gallery') as $file) {
                $galleryFiles[] = $file->store('products/gallery', 'public');
            }
            $data['gallery'] = json_encode($galleryFiles);
        }

        $product->update($data);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }



    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        if ($product->notes_top_image && Storage::disk('public')->exists($product->notes_top_image)) {
            Storage::disk('public')->delete($product->notes_top_image);
        }
        if ($product->notes_middle_image && Storage::disk('public')->exists($product->notes_middle_image)) {
            Storage::disk('public')->delete($product->notes_middle_image);
        }
        if ($product->notes_base_image && Storage::disk('public')->exists($product->notes_base_image)) {
            Storage::disk('public')->delete($product->notes_base_image);
        }
        if ($product->gallery) {
            $galleryImages = json_decode($product->gallery, true);
            if (is_array($galleryImages)) {
                foreach ($galleryImages as $img) {
                    if (Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }
        }
        $product->delete();

        return redirect()->back()->with('success', 'Product and its images deleted successfully!');
    }

    public function UserProductDetails($id){
        $product = Product::findOrFail($id);
        return view('details', compact('product'));
    }
}
