<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories'
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return redirect(route('categories.index'))->with('success', 'Category Created Successfully.');;
    }

    public function edit($id)
    {
      $category = Category::findOrFail($id);
      return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,'.$id
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->update();
        return redirect(route('categories.index'))->with('success', 'Category Updated Successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect(route('categories.index'))->with('success', 'Category Deleted Successfully.');
    }
}
