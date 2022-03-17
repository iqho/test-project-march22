<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use Illuminate\Http\Request;

class PriceTypeController extends Controller
{

    public function index()
    {
        $priceTypes = PriceType::orderBy('id', 'ASC')->get(['id','name']);
        return view('price-types.index', compact('priceTypes'));
    }

    public function create()
    {
        return view('price-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:price_types'
        ]);

        $ptype = new PriceType;
        $ptype->name = $request->name;
        $ptype->save();

        return redirect()->route('all.price-type')->with('success', 'Product Price Type Created Successfully.');;
    }

    public function edit(PriceType $ptype)
    {
        return view('price-types.edit', compact('ptype'));
    }

    public function update(Request $request, PriceType $ptype)
    {
        $request->validate([
            'name' => 'required|max:255|unique:price_types,name,'.$ptype->id
        ]);

        $ptype->name = $request->name;
        $ptype->update();

        return redirect()->route('all.price-type')->with('success', 'Product Price Type Updated Successfully.');
    }

    public function destroy(PriceType $ptype)
    {
        $ptype->delete();
        
        return redirect()->route('all.price-type')->with('success', 'Product Price Type Deleted Successfully.');
    }
}
