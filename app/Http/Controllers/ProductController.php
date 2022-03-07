<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id', 'asc')->get();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::Orderby('id', 'desc')->get(['id', 'name']);

        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:table,column,except,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_id' => 'required|integer',
        ]);

        //try{
            $product = new Product;
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

            $product->save();
        //}

        // catch (QueryException $e){
        //     $errorCode = $e->errorInfo[1];
        //     // if($errorCode == 1062){
        //     //     return redirect()->back()->withErrors('Title and Category are Same not Allow');
        //     // }
        //     switch ($errorCode) {
        //         case 1062://code dublicate entry
        //             return redirect()->back()->withErrors('Title and Category are Same not Allow');
        //             break;
        //         case 1364:
        //             return redirect()->back()->withErrors($e);
        //             break;
        //     }

        // }


        return redirect()->route('products.index')->with('success', 'Product Created Successfully.');
    }

    public function edit(Product $product)
    {

      $categories = Category::Orderby('id', 'desc')->get(['id', 'name']);

      return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_id' => 'required|integer'
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->is_active = $request->is_active ? $request->is_active : 0;
        $product->category_id = $request->category_id;
        $image = $request->file('image');

        if ($image) {
            $imageName = date("dmYhis").'.'.$image->getClientOriginalExtension();
            $image->move(public_path('product-images'), $imageName);
            if($product->image !== null){
                File::delete([public_path('product-images/'. $product->image)]);
            }
            $product->image = $imageName;
        }

            $product->update();

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully.');
    }

    public function destroy(Product $product)
    {
        File::delete([public_path('product-images/'. $product->image)]);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully.');
    }
}
