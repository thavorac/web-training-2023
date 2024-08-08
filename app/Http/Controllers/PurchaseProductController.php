<?php

namespace App\Http\Controllers;

use App\Models\PurchaseProduct;
use Illuminate\Http\Request;

class PurchaseProductController extends Controller
{
    public function getPurchaseProducts(){
       $purchaseProduct = PurchaseProduct::all();
       return $purchaseProduct;
    }

    public function getPurchaseProduct($purchaseProductId){
        $purchaseProduct = PurchaseProduct::find($purchaseProductId);

        if($purchaseProduct){
            return $purchaseProduct;
        }else{
            return response(["message"=>"purchase not found"],400);
        }
    }

    public function createPurchaseProduct(Request $request){

            // Calculate the amount
        $qty = $request->get('qty');
        $price = $request->get('price');
        $amount = $qty * $price;
        
        $purchaseProduct = new PurchaseProduct();

        $purchaseProduct->qty = $request->get('qty');
        $purchaseProduct->price = $request->get('price');
        $purchaseProduct->amount = $request->get('amount');
        $purchaseProduct->product_id = $request->get('product_id');
        $purchaseProduct->purchase_id = $request->get('purchase_id');

        $purchaseProduct->save();

        return ["message"=>"created success", "data"=>$purchaseProduct];

    }
  

    public function updatePurchaseProduct(Request $request, $purchaseProductId){
        $purchaseProduct = PurchaseProduct::find($purchaseProductId); 

        if($purchaseProduct){
            $purchaseProduct->qty = $request->get('qty');
            $purchaseProduct->price = $request->get('price');
            $purchaseProduct->amount = $request->get('amount');
            $purchaseProduct->product_id = $request->get('product_id');
            $purchaseProduct->purchase_id = $request->get('purchase_id');

            $purchaseProduct->save();

            return $purchaseProduct;

        }
    }

    public function deletePurchaseProduct($purchaseProductId){
        $purchaseProduct = PurchaseProduct::find($purchaseProductId);

        if($purchaseProduct){
            $purchaseProduct->delete();

            return \response(["message" => "delete success"]);
        }else{
            return \response(["message" => "purchase not found"],400);
        }
        return "delete 1 purcase";
    }

}
