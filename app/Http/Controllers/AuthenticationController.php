<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function register(Request $request) {
        // 1. Make sure that email is not used yet
        // $user = User::where("email", $request->get("email"))->get(); // return as []
        $userFound = User::where("email", $request->get("email"))->first(); // return as {}
        if ($userFound) {
            return response(["message" => "This email already exist"], 400);
        } else {
            // 2. Compare password with confirm password
            if ($request->get("password") == $request->get("confirm_password")) {
                // 3. Encrypt password before save to database
                $user = new User();
                $user->name = $request->get("username");
                $user->email = $request->get("email");
                $user->password = Hash::make($request->get("password"));
                $user->otp = mt_rand(100000, 999999);

                $user->save();

                Mail::to($user->email)->send(new OtpMail("http://locahost:9000/verify_otp?user_id=".$user->id."&otp=".$user->otp));

                return response(["message" => "good"]);
            } else {
                return response(["message" => "Password and Confirm Password are not match"], 400);
            }
        }
    }
}
