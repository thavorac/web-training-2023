<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories(){
        $categories = Category::all();

        return $categories;
    }
    public function createCategory(Request $request){
        $category = new Category();

        $category->name = $request->get('name');

        $category->save();

        return ["message"=>"create success","data"=>$category];

    }
    public function getCategory($categoryId){
        $category = Category::find($categoryId);

        if($category){
            return $category;
        }else{
            return response(["message"=>"Category not Found"],400);
        }

    }
    public function updateCategory(Request $request , $categoryId){
        
        $category = Category::find($categoryId);

        if($category){
            $category->name = $request->get('name');

            $category->save();

           return $category;
        }
    }
    public function deleteCategory($categoryId){
        $category = Category::find($categoryId);

        if($category){
            $category->delete();

            return ["message"=>"delete success"];
        }else{
            return response(["message"=>"Category not Found"],400);
        }

    }
    public function getProductsOfCategory($categoryId){
       $category = Category::find($categoryId);

       if($category){
            return $category->products;
       }else{
             return response(["message"=>"Category not Found"],400);

       }

    }
}
