<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User; // Make sure you have imported the User model if needed
use App\Models\Product;

class CartController extends Controller
{
    // Add product to cart
    public function addProductToCart(Request $request) {
        $userId = 1;//auth()->id(); // Retrieve authenticated user's ID

        // Create a new Cart instance
        $cart = new Cart();

        // Set product_id and user_id from the request
        $cart->product_id = $request->get('product_id');
        $cart->user_id = $userId; // Assign the retrieved user ID

        // Save the cart item
        $cart->save();

        // Return success response with the saved cart item
        return [ "message" => "success", "data" => $cart ];
    }

    // Remove product from cart
    public function removeProductFromCart(Request $request) {
        $userId = auth()->id(); // Retrieve authenticated user's ID

        // Attempt to delete the cart item for the specified product and user
        $success = Cart::where("product_id", $request->get('product_id'))
                        ->where("user_id", $userId) // Use retrieved user ID
                        ->delete();

        // Return success or fail message based on deletion success
        if ($success) {
            return ["message" => "success"];
        } else {
            return ["message" => "fail"];
        }
    }

    // Get products from cart for a specific user
    public function getProductsFromCart(Request $request) {
        $userId = auth()->id(); // Retrieve authenticated user's ID

        // Retrieve all cart items for the specified user
        $products = Cart::where("user_id", $userId)->get();

        // Return the retrieved products
        return $products;
    }
}
