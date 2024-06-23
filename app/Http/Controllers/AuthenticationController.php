<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function register(Request $request) {
        // 1. Make sure that email is not used yet
        $userFound = User::where("email", $request->get("email"))->first();
        if ($userFound) {
            return response(["message" => "This email already exists"], 400);
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

                $linkOTP = "http://localhost:9000/verify_otp?user_id=".$user->id."&otp=".$user->otp;
                Mail::to($user->email)->send(new OtpMail($linkOTP));

                return response(["message" => "Registration successful"]);
            } else {
                return response(["message" => "Password and Confirm Password do not match"], 400);
            }
        }
    }

    public function verifyOTP(Request $request) {
        $user = User::find($request->query('user_id'));

        if ($user) {
           if ($user->otp == $request->query('otp')) {
               $user->email_verified_at = Carbon::now();
               $user->save();

               return response(["message" => "Email is verified. You can start login"]);
           } else {
               return response(["message" => "OTP is invalid"], 400);
           }
        } else {
            return response(["message" => "User not found"], 400);
        }
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            return response(["message" => "Login successful", "user" => $user]);
        } else {
            return response(["message" => "Invalid credentials"], 401);
        }
    }

    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        // Generate a new reset password token
        $token = Str::random(60);

        // Update user record with the new token and timestamp
        $user->reset_password_token = $token;
        $user->reset_password_created_at = now();
        $user->save();

        Mail::to($user->email)->send(new ResetPasswordMail($token));

        return response()->json(['message' => 'Reset password link sent to your email', 'token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('reset_password_token', $request->input('token'))
            ->where('reset_password_created_at', '>=', now()->subHour())
            ->whereNotNull('reset_password_token') // Ensure token is not null
            ->first();
    
        if (!$user) {
            return response()->json(['message' => 'Invalid or expired token'], 400);
        }
    
        if ($request->input('password') !== $request->input('confirm_password')) {
            return response()->json(['message' => 'Password and Confirm Password do not match'], 400);
        }
    
        // Reset the user's password and clear the reset password token
        $user->password = Hash::make($request->input('password'));
        $user->reset_password_token = null;
        $user->reset_password_created_at = null;
        $user->save();
    
        return response()->json(['message' => 'Password reset successfully']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return response()->json(['message' => 'Logout successful']);
    }
}
