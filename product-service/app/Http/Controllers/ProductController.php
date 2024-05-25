<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product = new Product($request->all());
        $product->created_by = Auth::id();
        $product->save();

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate($request, [
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
