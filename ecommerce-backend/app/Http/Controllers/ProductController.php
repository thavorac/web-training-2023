<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // -- GET/api/products
    public function getProducts(){
        $products = Product::all();
        return $products;
    }


    // -- POST / api/products
    public function createProduct(Request $request){
        $product = new Product();
        $product->name = $request->get('name');
        $product->pricing = $request->get('pricing');
        $product->discount = $request->get('discount');
        $product->color = $request->get('color');
        $product->size = $request->get('size');
        $product->brand = $request->get('brand');
        $product->category_id = $request->get('category_id');
        $product->supplier_id = $request->get('supplier_id');

        $product->save();
        
        return ["message" =>"success" , "data" => $product ];
    }


    // -- PATCH / api/products/{productId}
    public function updateProduct(Request $request,$productId){
        
        $productFound = Product::find($productId);

        if($productFound){
            $productFound->name = $request->get('name');
            $productFound->save();

            return ["message"=>"updated","data"=>$productFound];
        }else{
            return response(["message"=>"Product not Found", 400]);
        }
    }

    // -- GET /api/products/{productId}
    public function getProduct($productId){
        $product = Product::find($productId);
        if($product){
            return $product;
        }else{
            return response(["message"=>"product not found"],400);
        }
    }

    // -- DELETE /api/products/{productId}
    public function deleteProduct($productId){
        $productFound = Product::find($productId);

        if($productFound){
            $productFound->delete();

            return ["message"=>"delete success"];
        }else{
            return response(["message"=>"Product not Found"],400);
        }

       
    }
    public function getImagesOfProduct(){
        
    }
    public function findProductsOfCategory($productId){
        $product = Product::find($productId);

        if($product){
            return $product->category;
        }else{
            return response(["message"=>"Can't found that product"],400);
        }
    }

    
}


