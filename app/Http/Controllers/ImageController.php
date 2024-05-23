<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function getImages(){
        $categories = Image::all();

        return $categories;
    }
    public function createImage(Request $request){
        $image = new Image();

        $image->images = $request->get('images');
        $image->product_id = $request->get('product_id');

        $image->save();

        return ["message"=>"create success","data"=>$image];
    }
    public function getImage($imageId){
        $image = Image::find($imageId);

        if($image){
            return $image;
        }else{
            return response(["message"=>"image not Found"],400);
        }
    }
    public function updateImage(Request $request , $imageId){    
        $image = Image::find($imageId);

        if($image){
            $image->images = $request->get('images');
            $image->product_id = $request->get('product_id');

            $image->save();

           return $image;
        }
    }
    public function deleteImage($imageId){
        $image = Image::find($imageId);
        if($image){
            $image->delete();
            return ["message"=>"delete success"];
        }else{
            return response(["message"=>"image not Found"],400);
        }
    }
    public function getProductsOfImage($imageId){
       $image = Image::find($imageId);

       if($image){
            return $image->products;
       }else{
             return response(["message"=>"image not Found"],400);
       }
    }
}
