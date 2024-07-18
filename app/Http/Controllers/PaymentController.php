<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function sendRecipe(Request $request)
    {
        // Get user email from the payment request
        $userEmail = $request->user()->email;

        // Dummy recipe content
        $recipe = "Here is your recipe:\n\nIngredients:\n- Ingredient 1\n- Ingredient 2\n\nInstructions:\n1. Step 1\n2. Step 2";

        // Send email with recipe
        Mail::raw($recipe, function ($message) use ($userEmail) {
            $message->to($userEmail)->subject('Your Recipe');
        });

        // Optionally, you can return a response if needed
        return response()->json(['message' => 'Recipe sent successfully'], 200);
    }
}
