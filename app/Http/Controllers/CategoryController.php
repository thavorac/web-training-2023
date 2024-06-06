<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;

class CategoryController extends Controller
{
    //Get/api/categries
    public function getCategories(){
        $categories = Category::all();
        return $categories;
    }

    //POST/api/categories
    public function createCategory(Request $request){
        // dd($request->get('name'));
        $category = new Category();
        $category -> name = $request->get('name');
        $category->save();

        return ["message" => "succes", "data" => $category];
    }
   // -- GET /api/categories/{categoryId}
    public function getCategory($categoryId) {
        // dd($categoryId);
        $category = Category::find($categoryId);
        if ($category) {
            return $category;
        } else {
            return response([ "message" => "category not found"], 400);
        }
    }
   
    //PATCH//api/categories{categoryID}
    public function updateCategory(Request $request, $categoryId){
       // dd($request);
        $categoryFound = Category::find($categoryId);
        if($categoryFound){
            $categoryFound->name = $request->get('name');
            $categoryFound->save();
            return $categoryFound;
        }else{
            return response([ "message" => "category not found"], 400);
        }
        return "update 1 category";
    }
    //DELETE/api/categories{categoryID}
    public function deleteCategory($categoryId){
        $categoryFound = Category::find($categoryId);

        if($categoryFound){
            $categoryFound->delete();
            return["message"=> "delete succes"];
        }else{
            return response(["message"=> "category not found"],400);
        }
       
    }
    //GET/api/categories/{categoryId/product}
    public function getProductsOfCategory(){
        return "get pruduct of 1 gategrory";
    }
}
