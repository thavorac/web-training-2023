<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class OrderController extends Controller
{

    public function add(Request $request)
    {
        try {
            $cart = Cart::where('id',$request->cart_id)
                ->where('active',true)->first();
    
            $subtotal = 0;
            foreach ($cart->cartItems as $cartitem) {
                $subtotal += $cartitem->pricing * $cartitem->quantity;
            }
    
            // Retrieve or create an active order
            $order = Order::create([
                'user_id' => Auth::id(), 
                'status' => 'Pending', 
                'total' => $subtotal
            ]);
    
            // Ensure 'price' is being set correctly
            foreach ($cart->cartItems as $cartitem) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $cartitem->product_id,
                    'quantity' => $cartitem->quantity,
                    'pricing' => $cartitem->pricing,
                    'discounted_price' => $cartitem->pricing,
                ]);
            }
            $cart->update(['active'=>false]);
            $r= Recipe::create(['order_id'=>$order->id]);
    
            return response()->json(['message' => 'Product added to order successfully!', 'order' => $order, 'recipe'=>$r]);
        } catch (\Exception $e) {
            Log::error('Order creation failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to add product to order', 'error' => $e->getMessage()], 500);
        }
    }
    

    /**
     * Remove a product from the order.
     */
    public function remove(Request $request, $id)
    {
        try {
            $cartItem = CartItem::findOrFail($request->cart_item_id);
            $orderProduct = OrderProduct::where('order_id', $id)
                ->where('product_id', $cartItem->product_id)
                ->first();
    
            if (!$orderProduct) {
                return response()->json(['message' => 'Order product not found.'], 404);
            }
    
            // Update the order total
            $order = $orderProduct->order;
            $order->total -= $orderProduct->pricing * $orderProduct->quantity;
            $order->save();
    
            // Remove the order product
            $orderProduct->delete();
    
            return response()->json(['message' => 'Product removed from order successfully!']);
        } catch (\Exception $e) {
            Log::error('Failed to remove product from order', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to remove product from order', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * View the current active order for the authenticated user.
     */
    public function view(Request $request)
    {
        $order = Order::all();

        if ($order) {
            return response()->json($order->map(function($o){
                $o->OrderProduct;
                return $o;}));
        }
        return response()->json([]);
    }
        public function show($orderId)
    {
        $orderProducts = OrderProduct::where('order_id', $orderId)->get();
        if ($orderProducts->isEmpty()) {
            return response()->json(['message' => 'Order products not found'], 404);
        }
        return response()->json($orderProducts, 200);
    }
    }
