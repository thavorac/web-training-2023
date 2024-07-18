<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use Carbon\Carbon;

class PromotionController extends Controller
{
        public function store(Request $request)
        {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'discount_percentage' => 'required|numeric|min:0|max:100',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'product_ids' => 'required|array',
                'product_ids.*' => 'exists:products,id'
            ]);
    
            // Create the promotion
            $promotion = Promotion::create($request->all());
    
            // Attach the products to the promotion
            if ($request->has('product_ids')) {
                $promotion->products()->attach($request->input('product_ids'));
            }
    
            // Apply discounts
            $this->applyDiscounts($promotion);
    
            // Load the products relationship to ensure they are included in the response
            $promotion->load('products');
    
            // Return the promotion with products
            return response()->json($promotion, 201);
        }
    
        public function applyDiscounts(Promotion $promotion)
        {
            $products = $promotion->products;
    
            foreach ($products as $product) {
                $product->applyDiscount();
            }
        }
    
        public function update(Request $request, Promotion $promotion)
        {
            $promotion->update($request->all());
    
            if ($request->has('product_ids')) {
                $promotion->products()->sync($request->input('product_ids'));
            }
    
            $this->applyDiscounts($promotion);
    
            return response()->json($promotion);
        }
    
        public function destroy(Promotion $promotion)
        {
            $promotion->delete();
    
            return response()->json(null, 204);
        }
    
        public function discountHistory()
        {
            $history = Promotion::with('products')->get();
            return response()->json($history);
        }
    
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
