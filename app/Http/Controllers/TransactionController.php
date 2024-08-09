<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderProduct; // Import Order model
use Illuminate\Support\Facades\DB;


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
// public function productSold(Request $request)
// {
//     $validated = $request->validate([
//         'order_id' => 'required|exists:orders,id',
//         'payment_amount' => 'required|numeric|min:0',
//         'payment_method' => 'required|string',
//         'account_id' => 'required|exists:accounts,id'
//     ]);

//     $order = Order::findOrFail($validated['order_id']);
//     $account = Account::findOrFail($validated['account_id']);
//     $paymentAmount = $validated['payment_amount'];
//     $paymentMethod = $validated['payment_method'];

//     // Check if payment amount matches the order total
//     if ($paymentAmount != $order->total_amount) {
//         return response()->json(['message' => 'Payment amount does not match order total'], 400);
//     }

//     // Update the order status to 'paid'
//     $order->status = 'paid';
//     $order->save();

//     // Update account balance
//     $account->balance -= $paymentAmount;
//     $account->save();

//     // Create transaction record
//     Transaction::create([
//         'account_id' => $account->id,
//         'type_Tran' => 'expense',
//         'balance' => -$paymentAmount,
//         'description' => 'Payment for order ID: ' . $order->id,
//         'order_id' => $order->id
//     ]);

//     // Optionally, send a receipt or confirmation email to the user
//     // Mail::to($user->email)->send(new PaymentConfirmation($order));

//     return response()->json([
//         'message' => 'Payment processed successfully',
//         'order_id' => $order->id,
//         'remaining_balance' => $account->balance
//     ], 200);
// }
public function productSold(Request $request)
{
    // Validate the request data
    $request->validate([
        'order_id' => 'required|exists:order_products,id',
        'description' => 'nullable|string',
    ]);

    DB::beginTransaction();
    try {
        // Retrieve the OrderProduct model
        $orderProduct = OrderProduct::findOrFail($request->order_id);

        // Create a new transaction using the pricing from the OrderProduct
        $transaction = Transaction::create([
            'account_id' => 1, // Set account_id to 1
            'type_Tran' => 'income', // Assuming income for product sold
            'balance' => $orderProduct->price, // Use the pricing from OrderProduct
            'description' => $request->description,
            'order_id' => $orderProduct->id,
        ]);

        // You can add additional logic here, e.g., update the order product status

        DB::commit();

        return response()->json([
            'status' => 'success',
            'data' => $transaction,
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
}

// public function orderProducts(Request $request)
// {
//     $validated = $request->validate([
//         'product_id' => 'required|exists:products,id',
//         'quantity' => 'required|integer|min:1',
//         'account_id' => 'required|exists:accounts,id'
//     ]);

//     $product = Product::findOrFail($validated['product_id']);
//     $account = Account::findOrFail($validated['account_id']);
//     $quantity = $validated['quantity'];

//     $totalCost = $product->cost_price * $quantity;

//     if ($account->balance < $totalCost) {
//         $quantityAffordable = floor($account->balance / $product->cost_price);
//         $totalCost = $product->cost_price * $quantityAffordable;
//     } else {
//         $quantityAffordable = $quantity;
//     }

//     $account->balance -= $totalCost;
//     $account->save();

//     $product->quantity += $quantityAffordable;
//     $product->save();

//     Transaction::create([
//         'account_id' => $account->id,
//         'type_Tran' => 'outcome',
//         'balance' => $totalCost,
//         'description' => 'Ordered products: ' . $product->name . ' x ' . $quantityAffordable,
//         'product_id' => $product->id
//     ]);

//     return response()->json([
//         'message' => 'Products ordered and transaction created successfully',
//         'quantity_ordered' => $quantityAffordable,
//         'total_balance' => $totalCost
//     ], 200);
// }
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
