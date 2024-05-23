<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //--GET /api/product
    public function getProducts(){
        return "get lis products";
    }
    //  POST/api/products
    public function createProduct(){
        return "create product";
    }
    // GET /api/products
    public function getProduct(){
        return "get 1 prodcut"
    }
    //  PATCH//api products{productId}
    public function updateProduct(){
        return "Update 1 product";
    }
    //  DELETE //api/products/{productId}
    public function deteProduct(){
        return "delete 1 product"
    }

}
