<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function getProducts(){
            $products = Product::with('images')->get();
            // ->orderBy('id','desc')->get();// ->paginate()
            return $products;
        }

        public function getFirstImage($productId)
        {
            $product = Product::with('firstImage')->find($productId);
        
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }
        
            $firstImage = $product->firstImage;
        
            if (!$firstImage) {
                return response()->json(['message' => 'No images found for this product'], 404);
            }
        
            return response()->json(['message' => 'First image retrieved successfully', 'data' => $firstImage]);
        }
    public function update_function(Request $request, $id)
    {
        // Find the product by its ID
        $product = Product::find($id);

        // Check if the product exists
        if ($product) {
            // Update the product attributes based on the request inputs
            $product->name = $request->input('name');
            $product->pricing = $request->input('pricing');
            $product->discount = $request->input('discount');
            $product->color = $request->input('color');
            $product->size = $request->input('size');
            $product->brand = $request->input('brand');
            $product->category_id = $request->input('category_id');
            $product->supplier_id = $request->input('supplier_id');

            // Save the updated product
            $product->save();

            // Redirect to the product view with a success message
            return redirect('productview')->with('success', 'Data Updated');
        } else {
            // Handle the case where the product with the given ID is not found
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    // -- POST / api/products
    // public function createProduct(Request $request){
    //     $product = new Product();
    //     $product->name = $request->get('name');
    //     $product->pricing = $request->get('pricing');
    //     $product->discount = $request->get('discount');
    //     $product->color = $request->get('color');
    //     $product->size = $request->get('size');
    //     $product->brand = $request->get('brand');
    //     $product->category_id = $request->get('category_id');
    //     $product->supplier_id = $request->get('supplier_id');


    //     $product->save();

    //     return ["message" =>"success" , "data" => $product ];
    //     // return redirect('product')->with('success','Data saved');
    // }


    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'pricing' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'color' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $product = new Product();
        $product->name = $validated['name'];
        $product->pricing = $validated['pricing'];
        $product->discount = $validated['discount'];
        $product->color = $validated['color'];
        $product->size = $validated['size'];
        $product->brand = $validated['brand'];
        $product->category_id = $validated['category_id'];
        $product->supplier_id = $validated['supplier_id'];

        $product->save();

        return response()->json(['message' => 'success', 'data' => $product]);
    }



    // // -- PATCH / api/products/{productId}
    public function updateProduct(Request $request, $productId)
    {

        $productFound = Product::find($productId);

        if ($productFound) {
            $productFound->name = $request->get('name');
            $productFound->discount = $request->input('discount');
            $productFound->color = $request->input('color');
            $productFound->size = $request->input('size');
            $productFound->brand = $request->input('brand');
            $productFound->category_id = $request->input('category_id');
            $productFound->supplier_id = $request->input('supplier_id');
            $productFound->pricing = $request->input('pricing');

            $productFound->save();

            return ["message" => "updated", "data" => $productFound];
        } else {
            return response(["message" => "Product not Found", 400]);
        }
    }


    // -- DELETE /api/products/{productId}
    public function deleteProduct($productId)
    {
        $productFound = Product::find($productId);

        if ($productFound) {
            $productFound->delete();

            return ["message" => "delete success"];
        } else {
            return response(["message" => "Product not Found"], 400);
        }
    }
    // -- GET /api/products/{productId}
    public function getProduct($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            return $product;
        } else {
            return response(["message" => "product not found"], 400);
        }
    }

    public function getImagesOfProduct()
    {
    }
    public function findProductsOfCategory($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            return $product->category;
        } else {
            return response(["message" => "Can't found that product"], 400);
        }
    }

    //     public function updateProduct($productId)
    // {
    //     try {
    //         // Find the product by its ID
    //         $product = Product::find($productId);

    //         if ($product) {
    //             // Return the product data
    //             return response()->json(['message' => 'success', 'data' => $product]);
    //         } else {
    //             // Return a 404 response if the product is not found
    //             return response()->json(['message' => 'Product not found'], 404);
    //         }
    //     } catch (\Exception $e) {
    //         // Handle any exceptions that occur during the database operation
    //         return response()->json(['message' => 'Error fetching product', 'error' => $e->getMessage()], 500);
    //     }
    // }
    public function index(){
        return Product::with(relation:'categories:id,name')
        ->get();

    }


}
