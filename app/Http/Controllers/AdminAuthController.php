<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && $admin->password === $credentials['password']) {
            // Passwords match (plain text comparison, not recommended in production)
            Auth::guard('admin')->login($admin);

            // Generate token (if using Sanctum or other token-based authentication)
            $token = $admin->createToken('admin-token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'admin' => $admin,
                'token' => $token, // Include the token in the response
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
