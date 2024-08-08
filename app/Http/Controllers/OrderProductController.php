<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the order products.
     */
    public function index()
    {
        $orderProducts = OrderProduct::all();
        return response()->json($orderProducts);
    }

    /**
     * Store a newly created order product in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pricing' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['sub_total'] = $data['pricing'] * $data['quantity'];

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'Pending',
            'total' => $data['sub_total'],
        ]);

        $orderProduct = OrderProduct::create(array_merge($data, ['order_id' => $order->id]));

        return response()->json($orderProduct, 201);
    }

    /**
     * Display the specified order product.
     */
    public function show(OrderProduct $orderProduct)
    {
        return response()->json($orderProduct);
    }

    /**
     * Display all order products for a specific order.
     */
    public function view($orderId)
    {
        $orderProducts = OrderProduct::where('order_id', $orderId)->get();

        if ($orderProducts->isEmpty()) {
            return response()->json(['message' => 'Order products not found'], 404);
        }

        return response()->json($orderProducts, 200);
    }

    /**
     * Update the specified order product in storage.
     */
    public function update(Request $request, OrderProduct $orderProduct)
    {
        $validator = Validator::make($request->all(), [
            'pricing' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if (isset($data['pricing']) || isset($data['quantity'])) {
            $pricing = $data['pricing'] ?? $orderProduct->pricing;
            $quantity = $data['quantity'] ?? $orderProduct->quantity;
            $data['sub_total'] = $pricing * $quantity;
        }

        $orderProduct->update($data);

        return response()->json($orderProduct);
    }

    /**
     * Remove the specified order product from storage.
     */
    public function destroy(OrderProduct $orderProduct)
    {
        $orderProduct->delete();
        return response()->json(['message' => 'Product removed from cart'], 200);
    }
}
