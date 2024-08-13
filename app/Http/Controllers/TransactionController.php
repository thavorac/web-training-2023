<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Order;
use App\Models\OrderProduct;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;


class TransactionController extends Controller
{
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'account_id' => 'required|exists:accounts,id',
    //         'type' => 'required|in:income,outcome',
    //         'balance' => 'required|numeric',
    //         'description' => 'nullable|string'
    //     ]);

    //     $transaction = Transaction::create($validated);
    //     $account = $transaction->account;
    //     $account->balance += $transaction->type == 'income' ? $transaction->balance : -$transaction->balance;
    //     $account->save();

    //     return $transaction;
    // }
    public function store(Request $request)
    {
        // Validate the request input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'pricing' => 'required|numeric',
            'quantity' => 'required|integer'
        ]);

        // Create the OrderProduct
        $orderProduct = OrderProduct::create($validated);

        // Return a success response with the created order product
        return response()->json([
            'message' => 'Order product created successfully',
            'order_product' => $orderProduct
        ], 201);
    }
    public function transfer(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'from_account_id' => 'required|exists:accounts,id',
            'to_account_id' => 'required|exists:accounts,id',
            'balance' => 'required|numeric|min:0'
        ]);
    
        // Retrieve the accounts
        $fromAccount = Account::find($validated['from_account_id']);
        $toAccount = Account::find($validated['to_account_id']);
        $balance = $validated['balance'];
        
        // Check if the from account has enough balance, adjust if necessary
        if ($fromAccount->balance < $balance) {
            $balance = $fromAccount->balance;
        }
    
        // Update the balances
        $fromAccount->balance -= $balance;
        $toAccount->balance += $balance;
        $fromAccount->save();
        $toAccount->save();
    
        // Log the transactions
        Transaction::create([
            'account_id' => $validated['from_account_id'],
            'type_Tran' => 'outcome',
            'balance' => $balance,
            'description' => 'Transfer to account ' . $toAccount->name
        ]);
    
        Transaction::create([
            'account_id' => $validated['to_account_id'],
            'type_Tran' => 'income',
            'balance' => $balance,
            'description' => 'Transfer from account ' . $fromAccount->name
        ]);
    
        // Return a success response
        return response()->json([
            'message' => 'Transfer successful',
            'transferred_balance' => $balance
        ], 200);
    }
    
// public function productSold(Request $request)
// {
//     $validated = $request->validate([
//         'product_id' => 'required|exists:products,id',
//         'quantity' => 'required|integer|min:1',
//         'account_id' => 'required|exists:accounts,id'
//     ]);

//     $product = Product::findOrFail($validated['product_id']);
//     $account = Account::findOrFail($validated['account_id']);
//     $quantity = $validated['quantity'];

//     if ($product->quantity < $quantity) {
//         return response()->json(['message' => 'Insufficient product quantity'], 400);
//     }

//     $balance = $product->pricing * $quantity;
//     $account->balance += $balance;
//     $account->save();

//     Transaction::create([
//         'account_id' => $account->id,
//         'type_Tran' => 'income',
//         'balance' => $balance,
//         'description' => 'Product sold: ' . $product->name . ' x ' . $quantity,
//         'product_id' => $product->id
//     ]);

//     return response()->json([
//         'message' => 'Product sold and transaction created successfully',
//         'quantity_sold' => $quantity,
//         'total_balance' => $balance
//     ], 200);
// }
// public function productSold($orderProductId)
// {
//     $orderProduct = OrderProduct::find($orderProductId);
//     // $products = $recipe->orderProducts; // Get all OrderProducts associated with this recipe
    
//     return response()->json($orderProduct);
// }
// public function productSold(Request $request)
// {
//     // Validate the request input to ensure order_product_id and account_id are provided
//     $validated = $request->validate([
//         'order_product_id' => 'required|exists:orders_product,id',
//         'account_id' => 'required|exists:accounts,id'
//     ]);

//     // Find the OrderProduct and related Product and Account
//     $orderProduct = OrderProduct::findOrFail($validated['order_product_id']);
//     $account = Account::findOrFail($validated['account_id']);

//     // Calculate the balance based on the pricing and quantity in the OrderProduct
//     $balance = $orderProduct->pricing * $orderProduct->quantity;

//     // Update the account balance
//     $account->balance += $balance;
//     $account->save();

//     // Create a new transaction for this sale
//     Transaction::create([
//         'account_id' => 2,
//         'type_Tran' => 'income',
//         'balance' => $balance,
//         'description' => 'Product sold: ' . $orderProduct->product->name . ' x ' . $orderProduct->quantity,
//         'product_id' => $orderProduct->product_id
//     ]);

//     // Return a success response with transaction details
//     return response()->json([
//         'message' => 'Product sold and transaction created successfully',
//         'quantity_sold' => $orderProduct->quantity,
//         'total_balance' => $balance
//     ], 200);
// }

// public function productSold(Request $request)
//     {
//         // Validate incoming request data
//         $validated = $request->validate([
//             'recipe_id' => 'required|exists:recipes,id',
//             'account_id' => 'required|exists:accounts,id',
//         ]);

//         return DB::transaction(function () use ($validated) {
//             // Retrieve the order with the provided order ID
//             $recipe_id = recipes::findOrFail($validated['recipe_id']);

//             // Ensure that the orderProducts relationship is not null and not empty
//             $orderProducts = $order->orderProducts ?? collect();

//             if ($orderProducts->isEmpty()) {
//                 return response()->json(['message' => 'No products found for this order.'], 404);
//             }


//             // Iterate over each order product and create a corresponding transaction
//             foreach ($orderProducts as $orderProduct) {
//                 // Calculate the balance as discounted price * quantity
//                 $balance = $orderProduct->discounted_price * $orderProduct->quantity;

//                 Transaction::create([
//                     'type_Tran' => 'income',
//                     'balance' => $balance,
//                     'description' => 'Sale of Product #' . $orderProduct->product_id . ' in Order #' . $order->id,
//                     'account_id' => $validated['account_id'],
//                     'recipe_id' => $recipe->id,
//                     'order_product_id' => $orderProduct->id,
//                 ]);
//             }

//             // Update the order status to 'completed'
//             $order->status = 'completed';
//             $order->save();

//             return response()->json(['message' => 'Transaction and recipe created successfully.'], 201);
//         });
//     }

public function orderProducts(Request $request)
{
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'account_id' => 'required|exists:accounts,id',
        'order_id' => 'required|exists:orders,id' // Assuming you have an Order model
    ]);

    $product = Product::findOrFail($validated['product_id']);
    $account = Account::findOrFail($validated['account_id']);
    $quantity = $validated['quantity'];
    $order = Order::findOrFail($validated['order_id']); // Fetch the order

    $totalCost = $product->cost_price * $quantity;

    if ($account->balance < $totalCost) {
        $quantityAffordable = floor($account->balance / $product->cost_price);
        $totalCost = $product->cost_price * $quantityAffordable;
    } else {
        $quantityAffordable = $quantity;
    }

    // Update the account balance
    $account->balance -= $totalCost;
    $account->save();

    // Update the product quantity
    $product->quantity += $quantityAffordable;
    $product->save();

    // Update the order status to completed
    $order->status = 'completed';
    $order->save();

    // Create the transaction record
    Transaction::create([
        'account_id' => $account->id,
        'type_Tran' => 'outcome',
        'balance' => -$totalCost,
        'description' => 'Ordered products: ' . $product->name . ' x ' . $quantityAffordable,
        'product_id' => $product->id,
        'order_id' => $order->id // Link transaction to the order
    ]);

    return response()->json([
        'message' => 'Products ordered and transaction created successfully',
        'quantity_ordered' => $quantityAffordable,
        'total_cost' => $totalCost,
        'remaining_balance' => $account->balance
    ], 200);
}



public function history()
{
    // Fetch all transactions with related account
    $transactions = Transaction::with('account')->get();

    // Format the transactions for the response
    $formattedTransactions = $transactions->map(function ($transaction) {
        return [
            'id' => $transaction->id,
            'account_name' => $transaction->account->name,
            'type_Tran' => $transaction->type_Tran,
            'balance' => number_format($transaction->balance, 2), // Correctly formatted balance
            'description' => $transaction->description,
            'date' => $transaction->created_at->format('d/m/Y'),
        ];
    });

    // Calculate the total balance
    $totalBalance = Account::sum('balance');

    return response()->json([
        'transactions' => $formattedTransactions,
        'total_balance' => number_format($totalBalance, 2) // Total balance formatted
    ]);
}


}
