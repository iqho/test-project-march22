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
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_id' => 'required|integer',
        ]);
        $product = new Product;
        $check_product = Product::where('title', '=', $request->title)->exists();
        $check_cat = Product::where('title', '=', $request->title)->where('category_id', '=', $request->category_id)->exists();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->is_active = $request->is_active ? $request->is_active : 0;
        $product->category_id = $request->category_id;
        $image = $request->file('image');
        if ($image) {
            $imageName = date("dmYhis").'.'.$image->getClientOriginalExtension();
            $image->move(public_path('product-images'), $imageName);
        }
        $product->image = $imageName;

        if($check_product == true && $check_cat == true){
            return redirect()->back()->withErrors('Title and Category are Same not Allow');
        }
        else{
            $product->save();
        }

        return redirect(route('products.index'))->with('success', 'Product Created Successfully.');
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
            'title' => 'required|max:255',
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
            $imageName = date("dmYhis").'.'.$image->getClientOriginalExtension();
            $image->move(public_path('product-images'), $imageName);
        }
        else{
            $imageName = $product->image;
        }

        $product->image = $imageName;

        $check_product = Product::where('title', '=', $request->title)->where('id','!=', $id)->exists();
        $check_cat = Product::where('title', '=', $request->title)->where('category_id', '=', $request->category_id)->where('id','!=', $id)->exists();

        if($check_product == true && $check_cat == true){
            return redirect()->back()->withErrors('Title and Category are same not allow');
        }
        else{
            $product->update();
        }

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
