<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        return Product::with('category')->get();
    }

    // Get a single product by ID
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }


    public function createProduct(Request $request){
        $product = new Product();
        $product->name = $request->get('name');
        $product->pricing = $request->get('pricing');
        $product->discount = $request->get('pricing');
        $product->color = $request->get('color');
        $product->size = $request->get('size');
        $product->brand = $request->get('brand');
        $product->category_id = $request->get('category_id');
        $product->supplier_id = $request->get('supplier_id');

        $product->save();

        return ["message" => "success","data"=>$product];
    }
    // // Create a new product
    // public function createProduct(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'image' => 'required',
    //         'description' => 'nullable|string',
    //         'price' => 'required|numeric',
    //         'category_id' => 'required|exists:categories,id',
    //     ]);

    //     $product = Product::create([
    //         'name' => $request->input('name'),
    //         'image' => $request->input('image'),
    //         'description' => $request->input('description'),
    //         'price' => $request->input('price'),
    //         'category_id' => $request->input('category_id'),

    //     ]);

    //     return response()->json($product, 201);
    // }

    // Update an existing product by ID
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update([
            'name' => $request->input('name'),
            'image' => $request->input('image'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json($product);
    }

    // Delete a product by ID
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}

