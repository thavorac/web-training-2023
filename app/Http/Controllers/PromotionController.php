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
        // 'status' => $request->status ?? 1, // assuming status is active by default
    ]);

    $this->attachProductsToPromotion($promotion, $request->products);

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
        // 'status' => $request->status ?? $promotion->status,
    ]);

    $productIds = $request->products;

    // Detach products that are not included in the update request
    $promotion->products()->whereNotIn('product_id', $productIds)->detach();

    // Update or attach products that are included in the update request
    $this->attachProductsToPromotion($promotion, $productIds);

    return response()->json($promotion);
}
private function attachProductsToPromotion(Promotion $promotion, array $productIds)
{
    foreach ($productIds as $productId) {
        $product = Product::find($productId);

        if ($product) {
            $discountedPrice = $this->isPromotionActive($promotion) ?
                $product->pricing * (1 - $promotion->discount_percentage / 100) :
                $product->pricing;

            $product->update(['discounted_price' => $discountedPrice]);
            $promotion->products()->syncWithoutDetaching([$productId => ['discount_price' => $discountedPrice]]);
        }
    }

    $this->updateProductDiscountedPrices();
}
private function updateProductDiscountedPrices()
{
    $activePromotions = Promotion::where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->get();

    $allProducts = Product::all();

    foreach ($allProducts as $product) {
        $activePromotion = $activePromotions->filter(function ($promotion) use ($product) {
            return $promotion->products->contains($product->id);
        })->first();

        if ($activePromotion) {
            $discountedPrice = $product->pricing * (1 - $activePromotion->discount_percentage / 100);
        } else {
            $discountedPrice = $product->pricing;
        }

        $product->update(['discounted_price' => $discountedPrice]);
    }
}


    // public function createPromotion(Request $request)
    // {
    //     $promotion = Promotion::create([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'discount_percentage' => $request->discount_percentage,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //         // 'status' => $request->status ?? 1, // assuming status is active by default
    //     ]);

    //     foreach ($request->products as $productId) {
    //         $product = Product::find($productId);

    //         if ($this->isPromotionActive($promotion)) {
    //             $discountedPrice = $product->pricing * (1 - $promotion->discount_percentage / 100);
    //         } else {
    //             $discountedPrice = $product->pricing;
    //         }

    //         $product->update(['discounted_price' => $discountedPrice]);
    //         $promotion->products()->attach($productId, ['discount_price' => $discountedPrice]);
    //     }

    //     return response()->json($promotion, 201);
    // }
    //     public function updatePromotion(Request $request, $id)
    //     {
    //         $promotion = Promotion::find($id);

    //         if (!$promotion) {
    //             return response()->json(['message' => 'Promotion not found'], 404);
    //         }

    //         $promotion->update([
    //             'name' => $request->name,
    //             'description' => $request->description,
    //             'discount_percentage' => $request->discount_percentage,
    //             'start_date' => $request->start_date,
    //             'end_date' => $request->end_date,
    //             // 'status' => $request->status ?? $promotion->status,
    //         ]);

    //         $productIds = $request->products;

    //         // Detach products that are not included in the update request
    //         $promotion->products()->whereNotIn('product_id', $productIds)->detach();

    //         // Update or attach products that are included in the update request
    //         foreach ($productIds as $productId) {
    //             $product = Product::find($productId);

    //             if ($this->isPromotionActive($promotion)) {
    //                 $discountedPrice = $product->pricing * (1 - $promotion->discount_percentage / 100);
    //             } else {
    //                 $discountedPrice = $product->pricing;
    //             }

    //             $product->update(['discounted_price' => $discountedPrice]);
    //             $promotion->products()->syncWithoutDetaching([$productId => ['discount_price' => $discountedPrice]]);
    //         }

    //         return response()->json($promotion);
    //     }
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
    // public function createPromotion(Request $request)
    // {
    //     $promotion = Promotion::create([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'discount_percentage' => $request->discount_percentage,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //         // 'status' => $request->status,
    //     ]);

    //     foreach ($request->products as $productId) {
    //         $product = Product::find($productId);

    //         if ($this->isPromotionActive($promotion)) {
    //             $discountedPrice = $product->pricing * (1 - $promotion->discount_percentage / 100);
    //             $product->update(['discounted_price' => $discountedPrice]);
    //             $promotion->products()->attach($productId, ['discount_price' => $discountedPrice]);
    //         } else {
    //             $product->update(['discounted_price' => 0]);
    //             $promotion->products()->attach($productId, ['discount_price' => 0]);
    //         }
    //     }

    //     return response()->json($promotion, 201);
    // }
    // public function listAllPromotions()
    // {
    //     $promotions = Promotion::with('products')->get();

    //     return response()->json($promotions);
    // }
        



    // public function show($id)
    // {
    //     $promotion = Promotion::with('products')->find($id);
        
    //     if (!$promotion) {
    //         return response()->json(['message' => 'Promotion not found'], 404);
    //     }

    //     return response()->json($promotion);
    // }
        



    // public function updatePromotion(Request $request, $id)
    // {
    //     $promotion = Promotion::find($id);

    //     if (!$promotion) {
    //         return response()->json(['message' => 'Promotion not found'], 404);
    //     }

    //     $promotion->update([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'discount_percentage' => $request->discount_percentage,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //         // 'status' => $request->status,
    //     ]);

    //     $productIds = $request->products;

    //     // Detach products that are not included in the update request
    //     $promotion->products()->whereNotIn('product_id', $productIds)->detach();

    //     // Update or attach products that are included in the update request
    //     foreach ($productIds as $productId) {
    //         $product = Product::find($productId);

    //         if ($this->isPromotionActive($promotion)) {
    //             $discountedPrice = $product->pricing * (1 - $promotion->discount_percentage / 100);
    //             $product->update(['discounted_price' => $discountedPrice]);
    //             $promotion->products()->syncWithoutDetaching([$productId => ['discount_price' => $discountedPrice]]);
    //         } else {
    //             $product->update(['discounted_price' => 0]);
    //             $promotion->products()->syncWithoutDetaching([$productId => ['discount_price' => 0]]);
    //         }
    //     }

    //     return response()->json($promotion);
    // }

    public function deletePromotion($id)
    {
        // Find the promotion
        $promotion = Promotion::find($id);

        if (!$promotion) {
            // Promotion not found
            return response()->json(['error' => 'Promotion not found'], 404);
        }

        // Handle related records
        foreach ($promotion->products as $product) {
            // Reset the discounted price for each product
            $product->update(['discounted_price' => 0]);
        }

        // Detach related products
        $promotion->products()->detach();

        // Delete the promotion
        $promotion->delete();

        // Return a success response
        return response()->json(['message' => 'Promotion deleted successfully'], 200);
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