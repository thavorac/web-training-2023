<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Promotion;
use App\Models\Product;
use Carbon\Carbon;

class PromotionController extends Controller
{
    /**
     * Update promotion statuses based on current date.
     */
    public function updatePromotionStatuses()
    {
        $today = Carbon::today();

        // Deactivate expired promotions
        $expiredPromotions = Promotion::where('end_date', '<', $today)
            ->where('status', true)
            ->get();

        foreach ($expiredPromotions as $promotion) {
            $promotion->status = false;
            $promotion->save();

            // Reset product prices
            foreach ($promotion->products as $product) {
                $product->pivot->discount_price = $product->price;
                $product->pivot->save();
            }
        }

        // Activate promotions starting today
        $startingPromotions = Promotion::where('start_date', '>=', $today)
            ->where('status', false)
            ->get();

        foreach ($startingPromotions as $promotion) {
            $promotion->status = true;
            $promotion->save();

            // Apply discount
            foreach ($promotion->products as $product) {
                $oldPrice = $product->price;
                $newPrice = $oldPrice - ($oldPrice * ($promotion->discount_percentage / 100));
                $product->pivot->discount_price = $newPrice;
                $product->pivot->save();
            }
        }
    }

    /**
     * Create a new promotion.
     */
    public function create(Request $request)
    {
        $this->updatePromotionStatuses(); // Update statuses before creating a new promotion

        $validated = $request->validate([
            'product_ids' => 'required|array|exists:products,id',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $promotion = Promotion::create([
                'name' => $validated['name'],
                'discount_percentage' => $validated['discount_percentage'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'status' => $validated['status'],
                'description' => $validated['description'],
            ]);

            $productData = [];
            foreach ($validated['product_ids'] as $productId) {
                $product = Product::findOrFail($productId);

                $oldPrice = $product->price;
                $newPrice = $oldPrice;

                if ($validated['status']) {
                    // Apply discount if promotion is active
                    $newPrice = $oldPrice - ($oldPrice * ($validated['discount_percentage'] / 100));
                }

                $productData[$productId] = [
                    'discount_price' => $newPrice,
                ];
            }

            $promotion->products()->sync($productData);

            DB::commit();

            return response()->json(['message' => 'Promotion created successfully', 'product_prices' => $productData], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create promotion', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update an existing promotion.
     */
    public function update(Request $request, $promotionId)
    {
        $this->updatePromotionStatuses(); // Update statuses before updating a promotion

        $validated = $request->validate([
            'product_ids' => 'sometimes|array|exists:products,id',
            'discount_percentage' => 'sometimes|numeric|min:0|max:100',
            'start_date' => 'sometimes|date|after_or_equal:today',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'status' => 'sometimes|boolean',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $promotion = Promotion::findOrFail($promotionId);

            // Check if the promotion end date is in the request and if it's after the current date
            if (isset($validated['end_date']) && $validated['end_date'] < now()) {
                return response()->json(['message' => 'Promotion end date must be in the future'], 400);
            }

            // Update promotion details
            $promotion->update(array_filter($validated));

            if (isset($validated['product_ids'])) {
                $productData = [];
                foreach ($validated['product_ids'] as $productId) {
                    $product = Product::findOrFail($productId);

                    $oldPrice = $product->price;
                    $newPrice = $oldPrice;

                    if ($promotion->status) {
                        // Apply new discount percentage if provided
                        if (isset($validated['discount_percentage'])) {
                            $newPrice = $oldPrice - ($oldPrice * ($validated['discount_percentage'] / 100));
                        } else {
                            // Use the existing discount percentage if not provided
                            $newPrice = $oldPrice - ($oldPrice * ($promotion->discount_percentage / 100));
                        }
                    }

                    $productData[$productId] = [
                        'discount_price' => $newPrice,
                    ];
                }

                $promotion->products()->syncWithoutDetaching($productData);
            }

            DB::commit();

            return response()->json(['message' => 'Promotion updated successfully', 'product_prices' => $productData ?? []], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update promotion', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a promotion.
     */
    public function destroy($promotionId)
    {
        try {
            DB::beginTransaction();

            $promotion = Promotion::findOrFail($promotionId);

            // Detach all products associated with the promotion
            $promotion->products()->detach();

            // Delete the promotion
            $promotion->delete();

            DB::commit();

            return response()->json(['message' => 'Promotion deleted successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete promotion', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all promotions.
     */
    public function index()
    {
        $this->updatePromotionStatuses(); // Update statuses before retrieving all promotions

        try {
            $promotions = Promotion::all();

            return response()->json(['promotions' => $promotions], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve promotions', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get promotion history with products.
     */
    public function history()
    {
        $this->updatePromotionStatuses(); // Update statuses before retrieving promotion history

        try {
            $promotions = Promotion::with('products')->get();

            $promotionHistory = $promotions->map(function ($promotion) {
                return [
                    'id' => $promotion->id,
                    'name' => $promotion->name,
                    'discount_percentage' => $promotion->discount_percentage,
                    'discount_amount' => $promotion->discount_amount,
                    'start_date' => $promotion->start_date,
                    'end_date' => $promotion->end_date,
                    'status' => $promotion->status,
                    'description' => $promotion->description,
                    'products' => $promotion->products->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'discount_price' => $product->pivot->discount_price,
                        ];
                    }),
                ];
            });

            return response()->json(['promotion_history' => $promotionHistory], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve promotion history', 'error' => $e->getMessage()], 500);
        }
    }
}

