<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail; // Import the OtpMail class
use Carbon\Carbon; // Import Carbon for date/time operations




class AuthenticationController extends Controller
{
   public function register(Request $request){
    // 1. check if email if it is already exit or not 
    $userFound = User::where("email",$request->get("email"))->first();

    if($userFound){
        return response(["message"=>"The email is already exist!"],400);
    }else{
        if($request->get("password") == $request->get("comfirm_password")){

            $user = new User();
            $user->name = $request->get("username");
            $user->email = $request->get("email");
            $user->password = Hash::make($request->get("password"));
            $user->otp = mt_rand(100000 , 999999);

            $user->save();

            //Send a 6 digits number to user's email, in format as this link:
            //http://localhost:9000/verify_otp?code=xxxxxx
            //http://localhost:80/verify_otp?user_id=xxxx&otp=xxxxxx
            Mail::to($user->email)->send(new OtpMail("http://localhost:80/verify_otp?user_id=".$user->id."&otp=".$user->otp));
            return response(["message"=>"good"]);
        }else{
            return response(["message"=>"Password and Comfirm_password are not match ."],400);
        }
        
    }
   }
   public function verifyOTP( Request $request){

    $code = $request->query('code');
    $userId = $request->query('user_id');
    $user = User::find($userId);
    if($user && $code == $user-otp);
    $user->save();
    return ["message" => "OTP is valid, your accound is register"];

   }
   else{
    return ["message" => "OTP is invalid",400];
   }
}