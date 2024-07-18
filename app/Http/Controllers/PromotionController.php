<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use Carbon\Carbon;

class PromotionController extends Controller
{
    /**
     * Store a newly created promotion in the database.
     */
    public function store(Request $request)
    {
        $promotion = Promotion::create($request->all());

        if ($request->has('product_ids')) {
            $promotion->products()->attach($request->input('product_ids'));
        }

        $this->applyDiscounts($promotion);

        return response()->json($promotion, 201);
    }

    /**
     * Apply discounts to products based on active promotions.
     */
    public function applyDiscounts(Promotion $promotion)
    {
        $products = $promotion->products;

        foreach ($products as $product) {
            $product->applyDiscount();
        }
    }

    /**
     * Update the specified promotion in the database.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $promotion->update($request->all());

        if ($request->has('product_ids')) {
            $promotion->products()->sync($request->input('product_ids'));
        }

        $this->applyDiscounts($promotion);

        // Update prices for all products
        $this->updateAllProductPrices();

        return response()->json($promotion);
    }

    /**
     * Remove the specified promotion from the database.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        // Update prices for all products
        $this->updateAllProductPrices();

        return response()->json(null, 204);
    }

    /**
     * Get the discount history for all promotions.
     */
    public function discountHistory()
    {
        $history = Promotion::with('products')->get();
        return response()->json($history);
    }

    /**
     * Update prices for all products based on active promotions.
     */
    private function updateAllProductPrices()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->applyDiscount();
        }
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
