<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentStrip;

class StripePaymentController extends Controller
{
    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('sk_test_51P1JoBFkNe48oU2ckvzj5VuBrF0ZaX7ASwHxLHLIgQDFFhz2uFPH0rENz2R6oJhMeNBlHAj8ftnXygPr6Dtitpeb00uQTjLvvj'));

        $user = Auth::user();
        $lineItems = [];

        foreach ($request->cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        // Save the payment data
        PaymentStrip::create([
            'user_id' => $user->id,
            'stripe_session_id' => $session->id,
            'amount' => array_reduce($request->cartItems, function($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0),
            'currency' => 'usd',
            'payment_status' => 'pending',
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function success()
    {
        // Update the payment status to 'completed' if payment is successful
        // This assumes you have a webhook endpoint to handle Stripe events
        return view('payment.success');
    }

    public function cancel()
    {
        // Handle the payment cancelation
        return view('payment.cancel');
    }
}
