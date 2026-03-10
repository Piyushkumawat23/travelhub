<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // List Products
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Show Create Form
    public function create()
    {
        $categories = Category::all();
         $brands = Brand::all();
        return view('admin.products.create',compact('categories','brands'));
    }

    // Store New Product
    
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'video_url' => 'nullable|url',
            'weight' => 'nullable|string',
            'warranty' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_trending' => 'nullable|boolean',
            'is_new_arrival' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // slug
        $data['slug'] = Str::slug($request->name);

        // SKU
        $data['sku'] = 'SKU-' . strtoupper(substr($request->name, 0, 3)) . '-' . time();

        // Thumbnail Image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $data['thumbnail_image'] = $filename;
        }

        // Product Create
        $product = Product::create($data);

        // Gallery Images
        if ($request->hasFile('gallery_images')) {

            foreach ($request->file('gallery_images') as $image) {

                $filename = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads/products/gallery'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $filename
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    // Show Edit Form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
         $brands = Brand::all();
        return view('admin.products.edit', compact('product','categories','brands'));
    }

    // Update Product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->video_url = $request->video_url;
        $product->weight = $request->weight;
        $product->warranty = $request->warranty;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->is_trending = $request->is_trending;
        $product->is_new_arrival = $request->is_new_arrival;
        $product->status = $request->status;
    
        // ----- IMAGE UPDATE -----
        if ($request->hasFile('image')) {

            if ($product->thumbnail_image && file_exists(public_path('uploads/products/'.$product->thumbnail_image))) {
                unlink(public_path('uploads/products/'.$product->thumbnail_image));
            }
        
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $filename);
        
            $product->thumbnail_image = $filename;  // FIXED HERE
        }
        
        if ($request->hasFile('gallery_images')) {

            foreach ($request->file('gallery_images') as $image) {

                $filename = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads/products/gallery'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $filename
                ]);
            }

        }
        $product->save();
    
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully!');
    }
    

    // Delete Product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Image delete karein
        if ($product->thumbnail_image && file_exists(public_path('uploads/products/' . $product->thumbnail_image))) {
            unlink(public_path('uploads/products/' . $product->thumbnail_image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}