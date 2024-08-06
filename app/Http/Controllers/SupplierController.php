<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;


class SupplierController extends Controller
{
    public function getSuppliers(){
        $suppliers = Supplier::with('products')->get(); // Eager load products

        return response()->json($suppliers);
    }

    public function getSupplier($supplierId){
        $supplier = Supplier::with('products')->find($supplierId);
        
        if($supplier){
            return response()->json($supplier);
        }else{
            return response(["message" => "Supplier not Found"], 400);
        }
    }
    
    public function createSupplier(Request $request){
        $supplier = new Supplier();

        $supplier->name = $request->get('name');
        $supplier->company = $request->get('company');
        $supplier->address = $request->get('address');
        $supplier->email = $request->get('email');
        $supplier->phone = $request->get('phone');
        $supplier->gender = $request->get('gender'); // Add this line
        
        $supplier->save();

        // Attach products to the supplier
        $productIds = $request->get('product_ids', []);
        $supplier->products()->attach($productIds);

        return ["message" => "success", "data" => $supplier->load('products')];
    }



    public function updateSupplier(Request $request, $supplierId){
        $supplier = Supplier::find($supplierId);

        if($supplier){
            $supplier->name = $request->get('name'); 
            $supplier->company = $request->get('company');
            $supplier->address = $request->get('address');
            $supplier->email = $request->get('email');
            $supplier->phone = $request->get('phone');
            $supplier->gender = $request->get('gender'); // Add this line

            $supplier->save();

            // Update product associations
            $productIds = $request->get('product_ids', []);
            $supplier->products()->sync($productIds);

            return ["message" => "Updated", "data" => $supplier->load('products')];
        }else{
            return response(["message" => "Supplier not Found"], 400);
        }
    }

    // public function deleteSupplier($supplierId){
    //     $supplierFound = Supplier::where("product_id",$request->get('product_id'));

    //     if($supplierFound){
    //         $supplierFound->delete();

    //         return ["message" => "delete supplier success", "data" => $supplierFound];
    //     }else{
    //         return response(["message" => "Supplier not Found"], 400);
    //     }
    // }

    public function deleteSupplier($supplierId){
        // Fetch supplier by supplierId
        $supplierFound = Supplier::find($supplierId);
    
        if($supplierFound){
            // Check for related purchases
            $relatedPurchases = Purchase::where('supplier_id', $supplierId)->exists();
    
            if($relatedPurchases){
                return response(["message" => "Cannot delete supplier with existing purchases"], 400);
            }
    
            // Delete the supplier if no related purchases
            $supplierFound->delete();
    
            return ["message" => "Delete supplier success", "data" => $supplierFound];
        }else{
            return response(["message" => "Supplier not Found"], 400);
        }
    }
    


}
