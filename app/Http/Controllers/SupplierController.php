<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function getSuppliers(){
        $supplier = Supplier:: all();
        return $supplier;
    }
    public function createSupplier(Request $request){
        $supplier = new Supplier();
        $supplier->name = $request->get('name');
        $supplier->adress = $request->get('adress');
        $request->phone = $request->get('phone');
        $request->email = $request->get('email');

        $supplier->save();
        return["message"=>"Create success!","data" => $supplier];
    }
    public function getSuppliers($supplierId){
        $supplier = Supplier::find($supplierId);
        if($supplier){
            return $supplier;
        }else{
            return respone(["message"=>"Product not found!"],400);
        }
    }
    public function updateSupplier(Reques $reques , $supplierId){
        $supplier = Supplier::find($supplierId);
        if($supplier){
            $supplier = new Supplier();
            $supplier->name = $request->get('name');
            $supplier->adress = $request->get('adress');
            $request->phone = $request->get('phone');
            $request->email = $request->get('email');
    
            $supplier->save();
            return $supplier;
        }else{
            return response(["message"=>"Supplier Not found!"],400);
        }
    }
}

