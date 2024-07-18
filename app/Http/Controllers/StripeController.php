<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class StripeController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $request->total,
            'status' => 'pending',
        ]);

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        $paymentIntent = PaymentIntent::create([
            'amount' => $order->total * 100, // Amount in cents
            'currency' => 'usd',
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
            'order_id' => $order->id,
        ]);
    }

    public function handlePaymentWebhook(Request $request)
    {
        // Handle Stripe webhook to update order status
    }
}