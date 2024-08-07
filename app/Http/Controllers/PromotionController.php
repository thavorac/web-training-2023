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
        ]);
    
        $this->attachProductsToPromotion($promotion, $request->products);
    
        // Update discounted prices for all products after creating a new promotion
        $this->updateProductDiscountedPrices();
    
        return response()->json($promotion, 201);
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
        ]);
    
        $productIds = $request->products;
    
        // Detach products that are not included in the update request
        $promotion->products()->whereNotIn('product_id', $productIds)->detach();
    
        // Update or attach products that are included in the update request
        $this->attachProductsToPromotion($promotion, $productIds);
    
        // Update discounted prices for all products after updating the promotion
        $this->updateProductDiscountedPrices();
    
        return response()->json($promotion);
    }
    
    private function attachProductsToPromotion(Promotion $promotion, array $productIds)
    {
        foreach ($productIds as $productId) {
            $product = Product::find($productId);
    
            if ($product) {
                $discountedPrice = $this->calculateDiscountedPrice($product, $promotion);
                $promotion->products()->syncWithoutDetaching([$productId => ['discount_price' => $discountedPrice]]);
            }
        }
    }
    
    private function updateProductDiscountedPrices()
    {
        $now = Carbon::now();
        $allProducts = Product::all();
    
        foreach ($allProducts as $product) {
            $activePromotion = $this->getActivePromotionForProduct($product);
    
            if ($activePromotion) {
                $discountedPrice = $this->calculateDiscountedPrice($product, $activePromotion);
            } else {
                $discountedPrice = $product->pricing;
            }
    
            $product->update(['discounted_price' => $discountedPrice]);
        }
    }
    
    
    private function calculateDiscountedPrice(Product $product, Promotion $promotion)
    {
        return $product->pricing * (1 - $promotion->discount_percentage / 100);
    }
    
    private function getActivePromotionForProduct(Product $product)
    {
        $now = Carbon::now();
        return $product->promotions()
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->orderBy('discount_percentage', 'desc')
            ->first();
    }
    
    public function listAllPromotions()
    {
        $promotions = Promotion::with('products')->get();
    
        $promotionsWithStatus = $promotions->map(function ($promotion) {
            $promotion->status = $this->isPromotionActive($promotion);
            return $promotion;
        });
    
        return response()->json($promotionsWithStatus);
    }
    
    public function show($id)
    {
        $promotion = Promotion::with('products')->find($id);
    
        if (!$promotion) {
            return response()->json(['message' => 'Promotion not found'], 404);
        }
    
        $promotion->status = $this->isPromotionActive($promotion);
    
        return response()->json($promotion);
    }
    
    private function isPromotionActive(Promotion $promotion)
    {
        $now = Carbon::now();
        return $promotion->start_date <= $now && $promotion->end_date >= $now;
    }
    
    public function deletePromotion($id)
    {
        $promotion = Promotion::find($id);
    
        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found'], 404);
        }
    
        $promotion->products()->detach();
        $promotion->delete();
    
        // Update product prices to reflect any other active promotions
        $this->updateProductDiscountedPrices();
    
        return response()->json(['message' => 'Promotion deleted successfully'], 200);
    }
    
    
    // public function discountHistory()
    // {
    //     $now = Carbon::now();

    //     // Get all products with their promotions
    //     $products = Product::with(['promotions' => function ($query) {
    //         $query->orderBy('start_date', 'asc');
    //     }])->get();

    //     $history = [];

    //     foreach ($products as $product) {
    //         foreach ($product->promotions as $promotion) {
    //             $discountPercentage = number_format($promotion->discount_percentage, 0); // Format percentage without decimals
    //             $history[] = [
    //                 'product_id' => $product->id,
    //                 'product_name' => $product->name,
    //                 'discount' => $discountPercentage . '%', // Append % sign
    //                 'start_date' => Carbon::parse($promotion->start_date)->format('d M Y'),
    //                 'end_date' => Carbon::parse($promotion->end_date)->format('d M Y'),
    //             ];
    //         }
    //     }

    //     return response()->json($history);
    // }
    public function discountHistory()
{
    $now = Carbon::now();

    // Get all products with their active promotions
    $products = Product::with(['promotions' => function ($query) use ($now) {
        $query->where('start_date', '<=', $now)
              ->orderBy('start_date', 'asc');
    }])->get();

    $history = [];

    foreach ($products as $product) {
        foreach ($product->promotions as $promotion) {
            $discountPercentage = number_format($promotion->discount_percentage, 0); // Format percentage without decimals
            $history[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'discount' => $discountPercentage . '%', // Append % sign
                'start_date' => Carbon::parse($promotion->start_date)->format('d M Y'),
                'end_date' => Carbon::parse($promotion->end_date)->format('d M Y'),
            ];
        }
    }

    return response()->json($history);
}





    
    

}
    // public function getPromotion($promotionId) {
    //     $promotion = Promotion::find($promotionId);
    //     return response()->json($promotion);
    // }