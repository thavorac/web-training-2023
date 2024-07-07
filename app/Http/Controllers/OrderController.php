<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cartItems = $request->get('cartItems');
        $total = $request->get('total');
        
        // Create a new order
        $order = new Order();
        $order->order_number = uniqid(); // Generate a unique order number
        $order->status = 'Pending';
        $order->total = $total; // Assuming you have a total column in your orders table
        $order->save();

        // Optionally, save the order items in another table (not shown here)
        // foreach ($cartItems as $item) {
        //     // Save each item to an order_items table
        // }
        return response()->json([
            'message' => 'Checkout successful',
            'order' => $order,
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }
}
