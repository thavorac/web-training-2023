<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.sk'));

        $totalAmountCents = (int) round($request->get('total') * 100);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Cart Total',
                        ],
                        'unit_amount' => $totalAmountCents,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        return response()->json(['id' => $session->id]);
 
    }

    public function success()
    {
        return "Thanks for your order! You have just completed your payment. The seller will reach out to you as soon as possible.";
    }

    public function cancel()
    {
        return "Payment was canceled!";
    }
}
