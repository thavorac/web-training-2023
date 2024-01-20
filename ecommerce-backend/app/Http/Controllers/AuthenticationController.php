<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail; // Import the OtpMail class



class AuthenticationController extends Controller
{
    public function register(Request $request){
        $userFound = User::where("email",$request->get("email"))->first();

        if($userFound){
            return response(["Message"=>"This email already exist."],400);
        }else{
            if($request->get("password") == $request->get("comfirm_password")){

                $user = new User();
                $user->name = $request->get("username");
                $user->email = $request->get("email");
                $user->password = Hash::make($request->get("password"));
                $user->otp = mt_rand(100000 , 999999);

                // $user->save();

                Mail::to($user->email)->send(new OtpMail("http://localhost:80/verify_otp?user_id=".$user->id."&opt=".$user->otp));
                return response(["message"=>"good"]);

   
            }else{
                return response(["Message"=>"Password and Confirm Password are not match ."],400);
            }
           
        }
        
    }
}
