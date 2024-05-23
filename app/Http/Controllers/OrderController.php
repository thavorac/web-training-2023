<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function getOrders(){
        $orders = Order::all();
        return $orders;
    }
    public function createOrder(Request $request){
        $order = new Order();

        $order->order_number = $request->get('order_number');
        $order->status = $request->get('status');

        $order->save();

        return ["message"=>"create success","data"=>$order];

    }
    public function getOrder($orderId){
        $order = Order::find($orderId);
        if($orderId){
            return $orderId();
        }
        else{
            return response(["message"=>'Order not found'],400);
        }
    }

    public function updateOrder(Reques $reques , $orderId){
        $order = Order::find($orderId);
        if($order){
            $order->order_number = $reques->get('order_number');
            $order->status = $reques->get('status');
            $order->save();

            return $order;
        }
        else{
            return response(["message"=>"Order not found!"],400);
        }
    }
    public function deleteOrder($orderId){
        $order = Order::find($orderId);
        if($orderId){
            $orderId->delete();
            return ["message"=>"Delete success!"];
        }
        else{
            return response(["message"=>"Order not found!"]);
        }

    }
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }
}
