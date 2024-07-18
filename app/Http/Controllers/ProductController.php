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

        public function getProducts(){
            return   Product::orderBy('id','asc')->paginate(20);
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
    public function createProduct(Request $request)
    {
        // Validate incoming request if needed
        $request->validate([
            'name' => 'required|string',
            'pricing' => 'required|numeric',
            'size' => 'required|string',
            'brand' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
            'description' => 'required|string',
        ]);
    
        // Check if product name already exists
        $existingProduct = Product::where('name', $request->input('name'))->first();
        if ($existingProduct) {
            return response()->json([
                'error' => 'Product with this name already exists'
            ], 409); // HTTP 409 Conflict status code
        }
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Get the file name with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload Image to public storage
            $path = $request->file('image')->storeAs('public', $fileNameToStore);
        } else {
            // Default image path if no image is uploaded
            $fileNameToStore = 'noimage.jpg';
        }
    
        // Create new product
        $product = new Product();
        $product->name = $request->get('name');
        $product->pricing = $request->get('pricing');
        $product->discounted_price = $request->get('pricing');
        $product->color = $request->get('color');
        $product->size = $request->get('size');
        $product->brand = $request->get('brand');
        $product->category_id = $request->get('category_id');
        $product->supplier_id = $request->get('supplier_id');

        $product->save();
    
        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }
    
    public function updateProduct(Request $request, $productId)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'pricing' => 'nullable|numeric',
                'size' => 'nullable|string|max:255',
                'brand' => 'nullable|string|max:255',
                'category_id' => 'nullable|integer|exists:categories,id',
                'image' => 'nullable|image|max:2048',
                'description' => 'nullable|string|max:255',
            ]);
    
            $productFound = Product::find($productId);
    
            if ($productFound) {
                // Update product fields if they exist in the request
                if ($request->has('name')) {
                    $productFound->name = $validatedData['name'];
                }
                if ($request->has('pricing')) {
                    $productFound->pricing = $validatedData['pricing'];
                }
                if ($request->has('size')) {
                    $productFound->size = $validatedData['size'];
                }
                if ($request->has('brand')) {
                    $productFound->brand = $validatedData['brand'];
                }
                if ($request->has('description')) {
                    $productFound->description = $validatedData['description'];
                }
                if ($request->has('category_id')) {
                    $productFound->category_id = $validatedData['category_id'];
                }
    
                // Handle image upload if new image is uploaded
                if ($request->hasFile('image')) {
                    // Get the file name with extension
                    $fileNameWithExt = $request->file('image')->getClientOriginalName();
                    // Get just the file name
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    // Get just the extension
                    $extension = $request->file('image')->getClientOriginalExtension();
                    // File name to store
                    $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                    // Upload Image to public storage
                    $path = $request->file('image')->storeAs('public', $fileNameToStore);
    
                    // Delete old image if exists and it's not the default image
                    if ($productFound->image != 'noimage.jpg' && Storage::disk('public')->exists($productFound->image)) {
                        Storage::disk('public')->delete($productFound->image);
                    }
    
                    // Assign the new image file name to the 'image' field
                    $productFound->image = $fileNameToStore;
                }
    
                $productFound->save();
    
                // Fetch the updated product data
                $updatedProduct = Product::find($productId);
    
                return response()->json(["message" => "Product updated successfully", "data" => $updatedProduct], 200);
            } else {
                return response()->json(["message" => "Product not found"], 404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(["message" => "Validation failed", "errors" => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(["message" => "An error occurred", "error" => $e->getMessage()], 500);
        }
    }
    
    // -- DELETE /api/products/{productId}
    public function deleteProduct($productId)
{
    $productFound = Product::find($productId);

    if ($productFound) {
        // Delete associated image file from storage
        if ($productFound->image && Storage::disk('public')->exists($productFound->image)) {
            Storage::disk('public')->delete($productFound->image);
        }

        // Delete the product record from the database
        $productFound->delete();

        return ["message" => "Delete success"];
    } else {
        return response()->json(["message" => "Product not found"], 404);
    }
}

public function getProduct($productId)
{
    $product = Product::find($productId);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    return response()->json([
        'message' => 'Product retrieved successfully',
        'data' => $product
    ], 200);
}

    public function getImagesOfProduct()
    {
    }
    public function findProductsOfCategory($productId)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}

