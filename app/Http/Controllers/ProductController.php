<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
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
        return view('admin.products.create',compact('categories'));
    }

    // Store New Product
    
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Generate slug
        $data['slug'] = Str::slug($request->name);

        // Generate SKU
        $data['sku'] = 'SKU-' . strtoupper(substr($request->name, 0, 3)) . '-' . time();

        // Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $data['thumbnail_image'] = $filename;

        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }


    // Show Edit Form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    // Update Product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
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
        
    
        $product->save();
    
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully!');
    }
    

    // Delete Product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Image delete karein
        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}