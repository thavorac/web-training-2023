<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function getImages(){
        $images = Image::all();

        return $images;
    }

    public function createImage(Request $request){
        $image = new Image();

        $image->images = $request->get('images');
        $image->product_id = $request->get('product_id');

        $image->save();

        return ["message"=>"image create success","data"=>$image];
    }

    public function getImage($imageId){
        $image = Image::find($imageId);

        if($image){
            return $image;
        }else{
            return response(['message'=>'Image not Found'],400);
        }
    }

    public function updateImage(Request $request,$imageId){
        $image = Image::find($imageId);

       if($image){
            
            $image->product_id = $request->get('product_id');

            $image->save();

            return ["message"=>"updated" , "data"=> $image];


       }

      
        
    }

    public function deleteImage($imageId){
       $imageFound = Image::find($imageId);

        if($imageFound){
            $imageFound->delete();

            return ["message"=>"delete success","data"=>$imageFound];
        }else{
            return response(["message"=>"Image not Found"],400);
        }
    }
}
