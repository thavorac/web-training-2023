<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return response()->json(['orderDetails' => $orderDetails]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $orderDetail = OrderDetail::create($validatedData);

        return response()->json(['orderDetail' => $orderDetail], 201);
    }

    public function show(OrderDetail $orderDetail)
    {
        return response()->json(['orderDetail' => $orderDetail]);
    }

    public function update(Request $request, OrderDetail $orderDetail)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $orderDetail->update($validatedData);

        return response()->json(['orderDetail' => $orderDetail]);
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();

        return response()->json(['message' => 'Order detail deleted successfully']);
    }
}
