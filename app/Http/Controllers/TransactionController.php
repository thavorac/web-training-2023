<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Purchase;

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
    public function productSold(Request $request)
{
    // Validate the request input
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'pricing' => 'required|numeric',
        'quantity' => 'required|integer',
        'order_id' => 'required|exists:orders,id',
        'discounted_price' => 'nullable|numeric',  // Add this if you use discounted_price in your OrderProduct table
    ]);

    // Create an OrderProduct entry
    $orderProduct = OrderProduct::create([
        'order_id' => $validated['order_id'],
        'product_id' => $validated['product_id'],
        'pricing' => $validated['pricing'],
        'quantity' => $validated['quantity'],
        'discounted_price' => $validated['discounted_price'] ?? null,  // Optional field
    ]);

    // Create a Recipe entry
    $recipe = Recipe::create([
        'order_id' => $validated['order_id']
    ]);

    // Return a success response with the created order product
    return response()->json([
        'message' => 'Order product and recipe created successfully',
        'order_product' => $orderProduct,
        'recipe' => $recipe
    ], 201);
}

    public function orderProducts(Request $request)
    {
        $validatedData = $request->validate([
            'qty' => 'required|integer',
            'total_price' => 'required|numeric',
            'supllier_id' =>'required|exists:supplier,id',
            'product_id' => 'required|exists:products,id',
        ]);
    
        $purchase = Purchase::create($validatedData);
    
        return response()->json([
            'message' => 'Purchase created successfully',
            'purchase' => $purchase
        ]);
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
