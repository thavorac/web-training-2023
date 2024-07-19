<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    public function createPromotion(Request $request)
    {
        $promotion = Promotion::create([
            'name' => $request->name,
            'description' => $request->description,
            'discount_percentage' => $request->discount_percentage,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        foreach ($request->products as $productId) {
            $product = Product::find($productId);

            if ($this->isPromotionActive($promotion)) {
                $discountedPrice = $product->pricing * (1 - $promotion->discount_percentage / 100);
                $product->update(['discounted_price' => $discountedPrice]);
                $promotion->products()->attach($productId, ['discount_price' => $discountedPrice]);
            } else {
                $product->update(['discounted_price' => 0]);
                $promotion->products()->attach($productId, ['discount_price' => 0]);
            }
        }

        return response()->json($promotion, 201);
    }
    public function listAllPromotions()
    {
        $promotions = Promotion::with('products')->get();

        return response()->json($promotions);
    }

    public function updatePromotion(Request $request, $id)
    {
        $promotion = Promotion::find($id);

        if (!$promotion) {
            return response()->json(['message' => 'Promotion not found'], 404);
        }

        $promotion->update([
            'name' => $request->name,
            'description' => $request->description,
            'discount_percentage' => $request->discount_percentage,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        $productIds = $request->products;

        // Detach products that are not included in the update request
        $promotion->products()->whereNotIn('product_id', $productIds)->detach();

        // Update or attach products that are included in the update request
        foreach ($productIds as $productId) {
            $product = Product::find($productId);

            if ($this->isPromotionActive($promotion)) {
                $discountedPrice = $product->pricing * (1 - $promotion->discount_percentage / 100);
                $product->update(['discounted_price' => $discountedPrice]);
                $promotion->products()->syncWithoutDetaching([$productId => ['discount_price' => $discountedPrice]]);
            } else {
                $product->update(['discounted_price' => 0]);
                $promotion->products()->syncWithoutDetaching([$productId => ['discount_price' => 0]]);
            }
        }

        return response()->json($promotion);
    }

    public function deletePromotion($id)
    {
        $promotion = Promotion::find($id);

        if (!$promotion) {
            return response()->json(['message' => 'Promotion not found'], 404);
        }

        $promotion->products()->each(function ($product) {
            $activePromotion = $product->promotions()
                ->where('status', true)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if (!$activePromotion) {
                $product->update(['discounted_price' => 0]);
            }
        });

        $promotion->delete();

        return response()->json(['message' => 'Promotion deleted successfully']);
    }

    private function isPromotionActive(Promotion $promotion)
    {
        $now = Carbon::now();
        return $promotion->status && $promotion->start_date <= $now && $promotion->end_date >= $now;
    }
    public function discountHistory()
    {
        $now = Carbon::now();

        // Get all products with their promotions
        $products = Product::with(['promotions' => function ($query) {
            $query->orderBy('start_date', 'asc');
        }])->get();

        $history = [];

        foreach ($products as $product) {
            foreach ($product->promotions as $promotion) {
                $history[] = [
                    'product_name' => $product->name,
                    'discount' => $promotion->discount_percentage . '% discount',
                    'start_date' => Carbon::parse($promotion->start_date)->format('d M Y'),
                    'end_date' => Carbon::parse($promotion->end_date)->format('d M Y'),
                ];
            }
        }

        return response()->json($history);
    }
}
