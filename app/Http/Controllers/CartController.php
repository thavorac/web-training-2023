// app/Http/Controllers/CartController.php
<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return $user->cart->products;
    }

    public function add(Request $request)
    {
        $user = auth()->user();
        $product = Product::findOrFail($request->product_id);
        $user->cart->products()->attach($product);
        return response()->json(['message' => 'Product added to cart'], 200);
    }

    public function remove(Request $request)
    {
        $user = auth()->user();
        $product = Product::findOrFail($request->product_id);
        $user->cart->products()->detach($product);
        return response()->json(['message' => 'Product removed from cart'], 200);
    }
}