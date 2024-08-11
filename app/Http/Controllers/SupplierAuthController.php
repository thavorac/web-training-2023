<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Supplier;

class SupplierAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $supplier = Supplier::where('email', $credentials['email'])->first();
        // dd($credentials);

        if ($supplier && Hash::check($credentials['password'], $supplier->password)) {
            // Passwords match
            Auth::guard('supplier')->login($supplier);

            // Generate token (if using Sanctum or other token-based authentication)
            $token = $supplier->createToken('supplier-token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'supplier' => $supplier,
                'token' => $token,
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
