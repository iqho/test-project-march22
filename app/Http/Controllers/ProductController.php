<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\PriceType;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    // try-catch                ; for any single crud or other type of action
    // DB::transaction()        ; when we use save/update in more than one table

    public function index()
    {
        $products = Product::orderBy('id', 'ASC')->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::Orderby('id', 'DESC')->get(['id', 'name']);
        $price_types = PriceType::Orderby('id', 'ASC')->get(['id', 'price_type']);

        return view('products.create', compact('categories', 'price_types'));
    }

    public function store(Request $request)
    {
        // form data validation
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'nullable',
        ]);

        try{
            // creating a product instance
            $product = new Product;

            // assigning form data to the product instance
            $product->title = $request->title;
            $product->description = $request->description;
            $product->is_active = $request->is_active ? $request->is_active : 0;
            $product->category_id = $request->category_id;

            $image = $request->file('image');
            if ($image) {
                $imageName = date("dmYhis").'.'.$image->getClientOriginalExtension();
                $image->move(public_path('product-images'), $imageName);
                $product->image = $imageName;
            }
            $product->save();

            $getAllPrices = $request->price;
            $price_type_id = $request->price_type_id;
            $active_date = $request->active_date;

            $values = [];

            foreach($getAllPrices as $index => $price){
                $values[] = [
                    'product_id' => $product->id,
                    'price' => $price,
                    'price_type_id' => $price_type_id[$index],
                    'active_date' => $active_date[$index],
                ];
            }

            $product->productPrices()->insert($values);

        } 
        
        catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
              return redirect()->back()->withErrors(['msg' => 'This product name already exits under selected category']);
            }
            else{
                return redirect()->back()->withErrors(['msg' => 'Unable to process request.Error:' . json_encode($e->getMessage(), true)]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product Created Successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::Orderby('id', 'DESC')->get(['id', 'name']);

        $price_types = PriceType::Orderby('id', 'ASC')->get(['id', 'price_type']);

        return view('products.edit', compact('product', 'categories', 'price_types'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'nullable',
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
        $product->delete();

        File::delete([public_path('product-images/'. $product->image)]);

        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully.');
    }

    public function ChangeStatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->is_active = $request->status;
        $product->save();

        return response()->json(['success'=>'Product Active Status Change Successfully.']);
    }

}