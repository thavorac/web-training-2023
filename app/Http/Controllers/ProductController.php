<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts(){
        $products = Product::all();
        return Product::all();
        return $products;

    }
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
    public function getProduct($productId){
        $product = Product::find($productId);

        if($product){
            return $product;
        }else{
            return response(["message"=>"product not Found"],400);
        }

    }
    public function updateProduct(Request $request , $productId){
        
        $product = Product::find($productId);

        if($product){
            $product->name = $request->get('name');
            $product->pricing = $request->get('pricing');
            $product->discount = $request->get('discount');
            $product->color = $request->get('color');
            $product->size = $request->get('size');
            $product->brand = $request->get('brand');
            // $product->category_id = $request->get('category_id');
            // $product->supplier_id = $request->get('supplier_id');

            $product->save();

           return $product;
        }
        else{
            return response(["message"=>"Product not found!"],400);
        }
    }
    public function deleteproduct($productId){
        $product = Product::find($productId);

        if($product){
            $product->delete();

            return ["message"=>"delete success"];
        }else{
            return response(["message"=>"product not Found"],400);
        }

    }
     // -- Add product to cart
     public function addProductToCart(Request $request) {
        $cart = new Cart();

        $cart->product_id = $request->get('product_id');
        $cart->user_id = $request->get('user_id');
        $cart->save();

        return [ "message" => "success", "data" => $cart ];
    }

    // -- Remove product from cart
    public function removeProductFromCart(Request $request) {
        $success = Cart::where("product_id", $request->get('product_id'))
                        ->where("user_id", $request->get('user_id'))
                        ->delete();
        if ($success) {
            return ["message" => "success"];
        } else {
            return ["message" => "fail"];
        }
    }

    public function getProductsFromCart(Request $request) {
        $products = Cart::where("user_id", $request->get('user_id'))->get();
        return $products;
    }
}
    
