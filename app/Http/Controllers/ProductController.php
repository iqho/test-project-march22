<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id', 'asc')->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::Orderby('id', 'desc')->get();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:products',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_id' => 'required|integer',
        ]);
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->is_active = $request->is_active ? $request->is_active : 0;
        $product->category_id = $request->category_id;
        $image = $request->file('image');
        if ($image) {
            $slug = Str::slug($request->title);
            $imageName = $slug.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('product-images'), $imageName);
        }
        $product->image = $imageName;
        $product->save();

        return redirect(route('products.index'))->with('success', 'Product Created Successfully.');;
    }

    public function edit($id)
    {
      $product = Product::findOrFail($id);
      $categories = Category::Orderby('id', 'desc')->get();
      return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255|unique:products,title,'.$id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_id' => 'required|integer'
        ]);
        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->is_active = $request->is_active ? $request->is_active : 0;
        $product->category_id = $request->category_id;
        $image = $request->file('image');
        if ($image) {
            if($product->image !== null){
                File::delete([public_path('product-images/'. $product->image)]);
            }
            $slug = Str::slug($request->title);
            $imageName = $slug.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('product-images'), $imageName);
        }
        else{
            $imageName = $product->image;
        }

        $product->image = $imageName;
        $product->update();

        return redirect(route('products.index'))->with('success', 'Product Updated Successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        File::delete([public_path('product-images/'. $product->image)]);
        $product->delete();
        return redirect(route('products.index'))->with('success', 'Product Deleted Successfully.');
    }
}
