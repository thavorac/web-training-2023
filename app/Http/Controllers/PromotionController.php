<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use Carbon\Carbon;

class PromotionController extends Controller
{
    // Display a listing of the promotions
    public function index()
    {
        $promotions = Promotion::all();
        return response()->json($promotions);
    }

    // Show the form for creating a new promotion
    public function create()
    {
        // return view('promotions.create'); // If using Blade templates
    }

    // Store a newly created promotion in storage
    public function store(Request $request)
    {
 
        $promotion = Promotion::create($request->only('name', 'description', 'discount_percentage', 'start_date', 'end_date', 'status'));
    
        if ($request->has('product_ids')) {
            foreach ($request->product_ids as $productId) {
                $product = Product::find($productId);
                if ($product) {
                    $discountPrice = $product->price * (1 - $request->discount_percentage / 100);
                    $promotion->products()->attach($product->id, ['discount_price' => $discountPrice]);
                }
            }
        }
    
        return response()->json(['message' => 'Promotion created successfully', 'promotion' => $promotion]);
    }
    

    // Display the specified promotion
    public function show($id)
    {
        $promotion = Promotion::findOrFail($id);
        return response()->json($promotion);
    }

    // Show the form for editing the specified promotion
    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        // return view('promotions.edit', compact('promotion')); // If using Blade templates
    }

    // Update the specified promotion in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $promotion = Promotion::findOrFail($id);
        $promotion->update($request->only('name', 'description', 'discount_percentage', 'start_date', 'end_date', 'status'));

        $promotion->products()->detach();

        foreach ($request->product_ids as $productId) {
            $product = Product::find($productId);
            $discountPrice = $product->price * (1 - $request->discount_percentage / 100);
            $promotion->products()->attach($product->id, ['discount_price' => $discountPrice]);
        }

        return response()->json(['message' => 'Promotion updated successfully', 'promotion' => $promotion]);
    }

    // Remove the specified promotion from storage
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return response()->json(['message' => 'Promotion deleted successfully']);
    }

    // Display discount history
    public function history()
    {
        $history = DB::table('product_promotion')
            ->join('products', 'product_promotion.product_id', '=', 'products.id')
            ->join('promotions', 'product_promotion.promotion_id', '=', 'promotions.id')
            ->select('products.name as product_name', 'promotions.name as promotion_name', 'promotions.discount_percentage', 'promotions.start_date', 'promotions.end_date')
            ->get();

        return response()->json($history);
    }
}
?>
