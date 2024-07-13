<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use Carbon\Carbon;

class PromotionController extends Controller
{
    public function createPromotion(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'products' => 'required|array|min:1',
            'products.*' => 'exists:products,id',
        ]);
    
        // Custom validation rule to check if end_date is not in the past
        $end_date = Carbon::parse($request->input('end_date'));
        $now = Carbon::now();
        if ($end_date < $now) {
            return response()->json(['error' => 'The end date cannot be in the past.'], 422);
        }
    
        $promotion = new Promotion();
        $promotion->name = $request->input('name');
        $promotion->description = $request->input('description');
        $promotion->discount_percentage = $request->input('discount_percentage');
        $promotion->start_date = $request->input('start_date');
        $promotion->end_date = $request->input('end_date');
    
        // Calculate promotion status based on current date
        if ($promotion->start_date <= $now && $promotion->end_date >= $now) {
            $promotion->status = true; // Promotion is active
        } else {
            $promotion->status = false; // Promotion is not active
        }
    
        $promotion->save();
    
        $products = $request->input('products');
        foreach ($products as $productId) {
            $product = Product::findOrFail($productId);
            
            $discountedPrice = $product->pricing - ($product->pricing * ($promotion->discount_percentage / 100));
            
            $promotion->products()->attach($productId, ['discount_price' => $discountedPrice]);
    
            // Update product discount based on promotion status
            if ($promotion->status) {
                $product->discount = $discountedPrice;
            } else {
                $product->discount = $product->pricing;
            }
            $product->save();
        }
    
        return response()->json(['message' => 'Promotion created successfully', 'promotion' => $promotion], 201);
    }
    public function getAllPromotions()
    {
        $promotions = Promotion::all();
        return response()->json([
            'promotions' => $promotions,
        ]);
    }
    
    public function getPromotionById($id)
    {
        $promotion = Promotion::with(['products.category'])->findOrFail($id);

        return response()->json(['promotion' => $promotion], 200);
    }
    public function updatePromotion(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'products' => 'required|array|min:1',
            'products.*' => 'exists:products,id',
        ]);
    
        // Custom validation rule to check if end_date is not in the past
        $end_date = Carbon::parse($request->input('end_date'));
        $now = Carbon::now();
        if ($end_date < $now) {
            return response()->json(['error' => 'The end date cannot be in the past.'], 422);
        }
    
        $promotion = Promotion::findOrFail($id);
        $promotion->name = $request->input('name');
        $promotion->description = $request->input('description');
        $promotion->discount_percentage = $request->input('discount_percentage');
        $promotion->start_date = $request->input('start_date');
        $promotion->end_date = $request->input('end_date');
    
        // Calculate promotion status based on current date
        if ($promotion->start_date <= $now && $promotion->end_date >= $now) {
            $promotion->status = true; // Promotion is active
        } else {
            $promotion->status = false; // Promotion is not active
        }
    
        $promotion->save();
    
        // Sync products for the promotion
        $products = $request->input('products');
        $syncData = [];
    
        foreach ($products as $productId) {
            $product = Product::findOrFail($productId);
            
            $discountedPrice = $product->pricing - ($product->pricing * ($promotion->discount_percentage / 100));
            
            // Attach product to promotion with discount price
            $syncData[$productId] = ['discount_price' => $discountedPrice];
    
            // Update product discount based on promotion status
            if ($promotion->status) {
                $product->discount = $discountedPrice;
            } else {
                $product->discount = $product->pricing;
            }
            $product->save();
        }
    
        // Sync products with promotion
        $promotion->products()->sync($syncData);
    
        return response()->json(['message' => 'Promotion updated successfully', 'promotion' => $promotion]);
    }
    
    public function deletePromotion($id)
    {
        $promotion = Promotion::find($id);

        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found'], 404);
        }

        // Detach all products associated with the promotion
        $promotion->products()->detach();

        // Delete the promotion
        $promotion->delete();

        return response()->json(['message' => 'Promotion deleted successfully'], 200);
    }
    public function discountHistory()
    {
        $promotions = Promotion::with(['products'])->get(); // Load promotions with related products

        $discountHistory = $promotions->flatMap(function ($promotion) {
            return $promotion->products->map(function ($product) use ($promotion) {
                $discountType = $promotion->discount_percentage !== null
                    ? number_format($promotion->discount_percentage, 2) . '% discount'
                    : '$' . number_format($product->pivot->discount_price, 2) . ' discount';

                return [
                    'product_name' => $product->name,
                    'discount_type' => $discountType,
                    'date_range' => $promotion->start_date->format('d M Y') . ' - ' . $promotion->end_date->format('d M Y'),
                ];
            });
        });

        return response()->json(['discount_history' => $discountHistory], 200);
    }    
}

