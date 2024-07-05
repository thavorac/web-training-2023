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
    // public function getPromotionById($id)
    // {
    //     try {
    //         $promotion = Promotion::with(['products'])->findOrFail($id);

    //         // Prepare response data
    //         $promotionDetails = [
    //             'id' => $promotion->id,
    //             'name' => $promotion->name,
    //             'description' => $promotion->description,
    //             // 'products' => $promotion->products,
    //             // 'products.*' =>$promotion->['promotion'],
    //             'discount_percentage' => $promotion->discount_percentage ,
    //             'start_date' => $promotion->start_date->format('Y-m-d'),
    //             'end_date' => $promotion->end_date->format('Y-m-d'),
    //             'status' => $promotion->status ? 'Active' : 'Inactive',
    //             'products' => [],
    //         ];

    //         // Iterate through each product associated with the promotion and include discounted price
    //         foreach ($promotion->products as $product) {
    //             // Determine the discounted price based on the promotion type
    //             $discountedPrice = $promotion->discount_percentage !== null
    //                 ? $product->pricing - ($product->pricing * ($promotion->discount_percentage / 100))
    //                 : $product->pivot->discount_pricing; // Adjust as per your logic

    //             $promotionDetails['products'][] = [
    //                 'id' => $product->id,
    //                 'name' => $product->name,
    //                 'original_price' => $product->pricing,
    //                 'discounted_price' => $discountedPrice,
    //             ];
    //         }
    //         return response()->json(['promotion' => $promotionDetails], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Promotion not found'], 404);
    //     }
    // }
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
            $promotion->status = 'Active'; // Promotion is active
        } else {
            $promotion->status = 'Inactive'; // Promotion is not active
        }
    
        $promotion->save();
    
        // Sync the promotion products with new data
        $products = $request->input('products');
        $promotion->products()->detach(); // Detach existing products
    
        foreach ($products as $productId) {
            $product = Product::findOrFail($productId);
            
            $discountedPrice = $product->pricing - ($product->pricing * ($promotion->discount_percentage / 100));
            
            $promotion->products()->attach($productId, ['discount_price' => $discountedPrice]);
    
            // Update product discount based on promotion status
            if ($promotion->status === 'Active') {
                $product->discount = $discountedPrice;
            } else {
                $product->discount = $product->pricing;
            }
            $product->save();
        }
    
        return response()->json(['message' => 'Promotion updated successfully', 'promotion' => $promotion], 200);
    }
    
    
    // public function updatePromotion(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'discount_percentage' => 'required|numeric|min:0|max:100',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:start_date',
    //         'products' => 'required|array|min:1',
    //         'products.*' => 'exists:products,id',
    //     ]);
    
    //     // Custom validation rule to check if end_date is not in the past
    //     $end_date = Carbon::parse($request->input('end_date'));
    //     $now = Carbon::now();
    //     if ($end_date < $now) {
    //         return response()->json(['error' => 'The end date cannot be in the past.'], 422);
    //     }
    
    //     $promotion = Promotion::findOrFail($id);
    
    //     // Store the original data before updating
    //     $originalData = $promotion->replicate();
    
    //     $promotion->name = $request->input('name');
    //     $promotion->description = $request->input('description');
    //     $promotion->discount_percentage = $request->input('discount_percentage');
    //     $promotion->start_date = $request->input('start_date');
    //     $promotion->end_date = $request->input('end_date');
    
    //     // Calculate promotion status based on current date
    //     if ($promotion->start_date <= $now && $promotion->end_date >= $now) {
    //         $promotion->status = true; // Promotion is active
    //     } else {
    //         $promotion->status = false; // Promotion is not active
    //     }
    
    //     $promotion->save();
    
    //     // Update associated products with new discount if promotion is active
    //     foreach ($request->input('products') as $productId) {
    //         $product = Product::findOrFail($productId);
    //         $discountedPrice = $product->price - ($product->price * ($promotion->discount_percentage / 100));

    //         // Attach product with the calculated discount price
    //         $promotion->products()->syncWithoutDetaching([$productId => ['discount_price' => $discountedPrice]]);

    //         // Update product discount based on promotion status
    //         if ($promotion->status) {
    //             $product->discount = $discountedPrice;
    //         } else {
    //             $product->discount = $product->price; // Reset to original price
    //         }
    //         $product->save();
    //     }
    
    //     return response()->json([
    //         'message' => 'Promotion updated successfully',
    //         'original_data' => $originalData, // Send the original data in the response
    //         'updated_data' => $promotion
    //     ], 200);
    // }
    

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












// public function getProductDetails($productId)
// {
//     try {
//         $product = Product::findOrFail($productId);

//         // Retrieve active promotions that affect this product
//         $activePromotions = Promotion::whereHas('products', function ($query) use ($productId) {
//             $query->where('products.id', $productId);
//         })->where('start_date', '<=', Carbon::now())
//           ->where('end_date', '>=', Carbon::now())
//           ->get();

//         $discountedPrice = $product->price; // Default to the original price if no active promotion

//         // Calculate the discounted price based on active promotions (assuming only one promotion affects the price)
//         foreach ($activePromotions as $promotion) {
//             $discountedPrice = $product->price - ($product->price * ($promotion->discount_percentage / 100));
//             break; // Assuming only one promotion affects the price, you can adjust this logic as per your business rules
//         }

//         return response()->json([
//             'product' => [
//                 'id' => $product->id,
//                 'name' => $product->name,
//                 'price' => $product->price,
//                 'discounted_price' => $discountedPrice,
//             ],
//             'active_promotions' => $activePromotions, // Optionally return active promotions affecting the product
//         ], 200);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Product not found'], 404);
//     }
// }







// public function getPromotionById($id)
// {
//     try {
//         $promotion = Promotion::with(['products'])->findOrFail($id);

//         // Calculate the discount type based on promotion data
//         $discountType = $promotion->discount_percentage !== null
//             ? number_format($promotion->discount_percentage, 2) . '% discount'
//             : 'Custom discount'; // You can adjust this based on your business logic

//         // Prepare response data
//         $promotionDetails = [
//             'id' => $promotion->id,
//             'name' => $promotion->name,
//             'description' => $promotion->description,
//             'discount_type' => $discountType,
//             'start_date' => $promotion->start_date->format('Y-m-d'),
//             'end_date' => $promotion->end_date->format('Y-m-d'),
//             'status' => $promotion->status ? 'Active' : 'Inactive',
//             'products' => [],
//         ];

//         // Iterate through each product associated with the promotion and include discounted price
//         foreach ($promotion->products as $product) {
//             // Determine the discounted price based on the promotion type
//             $discountedPrice = $promotion->discount_percentage !== null
//                 ? $product->price - ($product->price * ($promotion->discount_percentage / 100))
//                 : $product->pivot->discount_price; // Adjust as per your logic

//             $promotionDetails['products'][] = [
//                 'id' => $product->id,
//                 'name' => $product->name,
//                 'original_price' => $product->price,
//                 'discounted_price' => $discountedPrice,
//             ];
//         }

//         return response()->json(['promotion' => $promotionDetails], 200);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Promotion not found'], 404);
//     }
// }
