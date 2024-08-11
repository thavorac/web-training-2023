<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function getPurchases(){
        $purchases = Purchase::orderBy('id', 'desc')->get();
        return $purchases;
    }

    public function createPurchase(Request $request){
        $purchase = new Purchase();

        $purchase->qty = $request->get('qty');
        $purchase->status = $request->get('status');
        $purchase->supplier_id = $request->get('supplier_id');
        $purchase->product_id = $request->get('product_id');

        // Calculate total_price
        $product = Product::find($purchase->product_id);
        if ($product) {
            $purchase->total_price = $product->origin_price * $purchase->qty;
        } else {
            return response(["message" => "product not found"], 400);
        }

        $purchase->save();

        // Update product quantity if status is "accepted"
        if ($purchase->status === 'accepted') {
            $product->qty += $purchase->qty;
            $product->save();
        }

        return ["message" => "created successfully", "data" => $purchase];
    }

    public function getPurchase($purchaseId){
        $purchase = Purchase::find($purchaseId);

        if($purchase){
            return $purchase;
        }else{
            return response(["message" => "purchase not found"], 400);
        }
    }

    public function updatePurchase(Request $request, $purchaseId){
        $purchase = Purchase::find($purchaseId); 

        if($purchase){
            // Find the old product to adjust its quantity
            $oldProduct = Product::find($purchase->product_id);
            if ($oldProduct && $purchase->status === 'accepted') {
                $oldProduct->qty -= $purchase->qty;
                $oldProduct->save();
            }

            $purchase->qty = $request->input('qty');
            $purchase->status = $request->get('status');
            $purchase->supplier_id = $request->get('supplier_id');
            $purchase->product_id = $request->get('product_id');

            // Calculate total_price
            $product = Product::find($purchase->product_id);
            if ($product) {
                $purchase->total_price = $product->origin_price * $purchase->qty;
            } else {
                return response(["message" => "product not found"], 400);
            }

            $purchase->save();

            // Update product quantity if status is "accepted"
            if ($purchase->status === 'accepted') {
                $product->qty += $purchase->qty;
                $product->save();
            }

            return $purchase;
        } else {
            return response(["message" => "purchase not found"], 400);
        }
    }

    public function deletePurchase($purchaseId){
        $purchase = Purchase::find($purchaseId);

        if($purchase){
            // Adjust the product quantity when a purchase is deleted if the status was "accepted"
            $product = Product::find($purchase->product_id);
            if ($product && $purchase->status === 'accepted') {
                $product->qty -= $purchase->qty;
                $product->save();
            }

            $purchase->delete();
            return response(["message" => "delete success"]);
        }else{
            return response(["message" => "purchase not found"], 400);
        }
    }

    public function updateStatus($purchaseId, Request $request)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $oldStatus = $purchase->status;
        $purchase->status = $request->status;
        $purchase->save();

        // Update product quantity based on status change
        if ($oldStatus !== 'accepted' && $purchase->status === 'accepted') {
            $product = Product::find($purchase->product_id);
            if ($product) {
                $product->qty += $purchase->qty;
                $product->save();
            }
        } elseif ($oldStatus === 'accepted' && $purchase->status !== 'accepted') {
            $product = Product::find($purchase->product_id);
            if ($product) {
                $product->qty -= $purchase->qty;
                $product->save();
            }
        }

        return response()->json(['message' => 'Status updated successfully']);
    }
}
