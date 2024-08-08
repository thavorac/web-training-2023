<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the cart items.
     */
    public function index()
    {
        $cartItems = CartItem::all();
        return response()->json($cartItems);
    }

    /**
     * Store a newly created cart item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'pricing' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'sub_total' => 'required|numeric',
        ]);

        $cartItem = CartItem::create($validated);

        return response()->json($cartItem, 201);
    }

    /**
     * Display the specified cart item.
     */
    public function show(CartItem $cartItem)
    {
        return response()->json($cartItem);
    }

    /**
     * Update the specified cart item in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $validated = $request->validate([
            'product_id' => 'sometimes|exists:products,id',
            'pricing' => 'sometimes|numeric',
            'quantity' => 'sometimes|integer|min:1',
            'sub_total' => 'sometimes|numeric',
        ]);

        $cartItem->update($validated);

        return response()->json($cartItem);
    }

    /**
     * Remove the specified cart item from storage.
     */
    public function destroy($cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Product removed from cart'], 200);
        }

        return response()->json(['message' => 'Product not found in cart'], 404);
    }

}
