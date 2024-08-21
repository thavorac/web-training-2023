<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $subtotal = $product->price * $request->quantity;
        $cart = Cart::where('user_id',Auth::id())->where('active',true)->first();
        if(!$cart){
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'active' => true,
                'total' => 0,
            ]);
        }
        $cartItem = CartItem::firstOrNew(
            [
                'cart_id'=>$cart->id,
                'product_id'=>$product->id
            ],
            [
                'cart_id'=>$cart->id,
                'product_id'=>$product->id, 
                'pricing'=>$product->pricing, 
                'quantity'=>$request->quantity,
                'discounted_price' => $product->discounted_price
            ]
        );
        if($cartItem->id)$cartItem->quantity+=$request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Product added to cart successfully!', 'cart' => $cart]);
    }

    public function remove(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->where('id', $id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }

        $cart->delete();

        return response()->json(['message' => 'Product removed from cart successfully!']);
    }

    public function view()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('active',true)->first();
        if($cart){
            $items = CartItem::where('cart_id',$cart->id)->with('product')->get();
            return response()->json($items);
        }
        return response()->json([]);
    }
}
