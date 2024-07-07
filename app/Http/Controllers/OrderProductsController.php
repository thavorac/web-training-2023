<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct; 

class OrderProductsController extends Controller
{
    public function index()
    {
        $orderProducts = OrderProduct::all();
        return response()->json($orderProducts, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'style' => 'required',
            'product_id' => 'required',
            'order_id' => 'required',
        ]);

        // Create a new OrderProduct instance with timestamps managed by Eloquent
        $orderProduct = new OrderProduct([
            'style' => $request->input('style'),
            'product_id' => $request->input('product_id'),
            'order_id' => $request->input('order_id'),
        ]);

        $orderProduct->save(); // Save the order product instance

        return response()->json(["message" => "Create success", "data" => $orderProduct], 201);
    }

    public function show($id)
    {
        $orderProduct = OrderProduct::find($id);

        if ($orderProduct) {
            return response()->json($orderProduct, 200);
        } else {
            return response()->json(["message" => "Order product not found"], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $orderProduct = OrderProduct::find($id);

        if ($orderProduct) {
            $request->validate([
                'product_id' => 'required',
                'order_id' => 'required'
            ]);

            $orderProduct->product_id = $request->input('product_id');
            $orderProduct->order_id = $request->input('order_id');
            $orderProduct->save();

            return response()->json($orderProduct, 200);
        } else {
            return response()->json(["message" => "Order product not found"], 404);
        }
    }

    public function destroy($id)
    {
        $orderProduct = OrderProduct::find($id);

        if ($orderProduct) {
            $orderProduct->delete();
            return response()->json(["message" => "Delete success"], 200);
        } else {
            return response()->json(["message" => "Order product not found"], 404);
        }
    }

}
