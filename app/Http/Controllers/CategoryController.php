<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id', 'ASC')->get(['id','name']);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category Created Successfully.');;
    }

    public function edit(Category $category)
    {
      return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,'.$category->id
        ]);

        $category->name = $request->name;
        $category->update();

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully.');
    }

    public function destroy(Category $category)
    {

        $products = Product::where('category_id', $category->id)->count();
        
        if($products > 0){
            Product::where('category_id', $category->id)->update(['category_id' => 1]);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully.');
    }
}
