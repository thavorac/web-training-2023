<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // -- GET /api/products
    public function getProducts() {
        return Product::all();
    }

    // -- POST /api/products
    public function createProduct(Request $request) {
        $product = new Product();
        $product->name = $request->get('name');
        $product->pricing = $request->get('pricing');
        $product->discount = $request->get('discount');
        $product->color = $request->get('color');
        $product->size = $request->get('size');
        $product->brand = $request->get('brand');
        $product->category_id = $request->get('category_id');

        $product->save();

        return [ "message" => "success", "data" => $product ];
    }

    // -- PATCH /api/products/{productId}
    public function updateProduct() {
        return "update 1 product";
    }

    // -- GET /api/products/{productId}
    public function getProduct() {
        return "get 1 product";
    }

    // -- DELETE /api/products/{productId}
    public function deleteProduct() {
        return "delete 1 product";
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
