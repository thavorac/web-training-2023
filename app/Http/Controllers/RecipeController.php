<?php

namespace App\Http\Controllers;

use App\Exports\ReceiptsExport;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json($recipes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            // Add other validation rules as needed
        ]);

        $recipe = Recipe::create($request->all());
        return response()->json($recipe, 201);
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $recipe = Recipe::with('order')-> findOrFail($id);
    //     $recipe->order->OrderProduct;
    //     return response()->json($recipe);
    // }
    public function show($id)
    {
        $recipe = Recipe::with(['order.orderProduct.product'])->findOrFail($id);
        return response()->json($recipe);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            // Add other validation rules as needed
        ]);

        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->all());
        return response()->json($recipe);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return response()->json(null, 204);
    }
    public function export() 
    {
        return Excel::download(new ReceiptsExport, 'receipts.xlsx');
    }
}

