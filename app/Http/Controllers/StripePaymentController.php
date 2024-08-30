<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentStrip;
class StripePaymentController extends Controller
{
    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = Auth::user();
        
        $lineItems = [];

        foreach ($request->cartItems as $item) {
            $productName = $item['name'] ?? 'Unnamed Product';

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $productName,
                    ],
                    'unit_amount' => $item['pricing'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('payment.success',['token'=>$request->token,'cartItems'=>json_encode($request->cartItems)]),
                'cancel_url' => route('payment.cancel'),
            ]);
            
            session(['cartItems'=>12]);
            return response()->json(['id' => $session->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success()
    {
        $cartItems=json_decode(request()->cartItems);
        $hashedToken =request()->token;
        $token = PersonalAccessToken::findToken($hashedToken);
        
        $user = $token->tokenable;
        // Assume that cart_id is passed with the session or through request
        $order = $this->createOrder($cartItems,$user);
        $cart = Cart::where('user_id', $user->id)->where('active',true)->first();
        $cart->update(['active'=>false]);
        // Create a recipe for the order
        $recipe = Recipe::create(['order_id' => $order->id]);
        //return response()->json(['success' => true, 'recipe' => $recipe]);
        //redirect to receipt page
        return redirect('http://localhost:5174/receipt/'.$recipe->id);
    }

    public function cancel()
    {
        return view('payment.cancel');
    }

    public function createOrder($cartItems,$user):Order
    {
        $subtotal = 0;
        foreach ($cartItems as $cartitem) {
            $subtotal += $cartitem->pricing * $cartitem->quantity;
        }

        // Retrieve or create an active order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'completed',
            'total' => $subtotal
        ]);

        // Ensure 'price' is being set correctly
        foreach ($cartItems as $cartitem) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cartitem->product_id,
                'quantity' => $cartitem->quantity,
                'pricing' => $cartitem->pricing,
                'discounted_price' => $cartitem->pricing,
            ]);
        }
        return $order;
    }
}

