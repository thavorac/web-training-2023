<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product; // Import the Product model
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

            return $purchase;
        } else {
            return response(["message" => "purchase not found"], 400);
        }
    }

    public function deletePurchase($purchaseId){
        $purchase = Purchase::find($purchaseId);

        if($purchase){
            $purchase->delete();
            return response(["message" => "delete success"]);
        }else{
            return response(["message" => "purchase not found"], 400);
        }
    }
    public function updateStatus($purchaseId, Request $request)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->status = $request->status;
        $purchase->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
