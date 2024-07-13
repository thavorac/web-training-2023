/ app/Http/Controllers/OrderController.php
<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class OrderController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->amount * 100; // Convert to cents
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
        ]);

        return response()->json(['client_secret' => $paymentIntent->client_secret]);
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $request->total,
        ]);

        // Add products to the order...

        return response()->json($order, 201);
    }
}