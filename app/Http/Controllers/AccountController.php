<?php
namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function createAccount(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|in:income,outcome',
                'default' => 'required|in:main,sale,buy,employee_salaries',
            ]);
    
            // Create a new account with the validated name, a balance of 0, and type as 'income'
            $account = Account::create([
                'name' => $validatedData['name'],
                'type' => $validatedData['type'],
                'default' => $validatedData['default'],
                'balance' => 0, // Set balance to 0'
            ]);
    
            return response()->json(['success' => true, 'account' => $account], 201);
        } catch (\Exception $e) {
            // Log the exception message
            \Log::error('Account creation failed: ' . $e->getMessage());
    
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    
    public function showAllAccounts()
    {
        $accounts = Account::all();
        return response()->json($accounts);
    }

    public function showAccount($id)
    {
        $account = Account::find($id);

        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        return response()->json($account);
    }

    public function updateAccount(Request $request, Account $account)
    {
        // Directly update the account with the request data
        $account->update($request->all());
    
        // Return the updated account as a JSON response
        return response()->json($account);
    }
    

    public function deleteAccount(Account $account)
    {
        $account->delete();

        return response()->json(null, 204);
    }
    public function history($id)
    {
        // Fetch the account with its transactions
        $account = Account::with('transactions')->findOrFail($id);
    
        // Format transactions and include the account name
        $transactions = $account->transactions->map(function($transaction) use ($account) {
            return [
                'id' => $transaction->id,
                'account_name' => $account->name,
                'type_Tran' => $transaction->type_Tran, //type of transaction
                'balance' => $transaction->balance,
                'total_balance'=>$account->balance,
                'description' => $transaction->description,
                'date' => $transaction->created_at->format('d/m/Y'),
            ];
        });
    
        return response()->json([
            'transactions' => $transactions,
        ]);
    }   
//     public function accountStatistics()
// {
//     try {
//         // Fetch all default accounts
//         $accounts = Account::whereIn('default', ['main', 'sale', 'buy', 'employee_salaries'])->get();

//         // Initialize the statistics array
//         $statistics = [];

//         // Loop through each account and calculate total income and outcome
//         foreach ($accounts as $account) {
//             // Calculate income and outcome separately
//             $income = $account->transactions()->where('type_Tran', 'income')->sum('balance');
//             $outcome = $account->transactions()->where('type_Tran', 'outcome')->sum('balance');

//             // Add to statistics array
//             $statistics[] = [
//                 'account_name' => $account->name,
//                 'default' => $account->default,
//                 'income' => $income,
//                 'outcome' => $outcome,
//             ];
//         }

//         // Return the statistics data as a JSON response
//         return response()->json(['success' => true, 'statistics' => $statistics], 200);

//     } catch (\Exception $e) {
//         // Log any exception messages
//         \Log::error('Error generating account statistics: ' . $e->getMessage());

//         return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
//     }
// }
public function accountStatistics()
{
    try {
        // Fetch all default accounts
        $accounts = Account::whereIn('default', ['main', 'sale', 'buy', 'employee_salaries'])->get();

        // Initialize the statistics array
        $statistics = [];
        $totalIncome = 0;
        $totalOutcome = 0;

        // Loop through each account and calculate total income and outcome
        foreach ($accounts as $account) {
            // Calculate income and outcome separately
            $income = $account->transactions()->where('type_Tran', 'income')->sum('balance');
            $outcome = $account->transactions()->where('type_Tran', 'outcome')->sum('balance');
            
            // Add to total income and outcome
            $totalIncome += $income;
            $totalOutcome += $outcome;

            // Fetch transactions for the account
            $transactions = $account->transactions()->get()->map(function ($transaction) {
                return [
                    'balance' => $transaction->balance,
                    'type_Tran' => $transaction->type_Tran,
                    'description' => $transaction->description,
                    'date' => $transaction->created_at->format('d/m/Y'),
                ];
            });

            // Add to statistics array
            $statistics[] = [
                'account_name' => $account->name,
                'default' => $account->default,
                'income' => number_format($income, 2), // Format income as decimal
                'outcome' => number_format($outcome, 2), // Format outcome as decimal
                'transactions' => $transactions,
            ];
        }

        // Prepare the response data
        $response = [
            'success' => true,
            'statistics' => $statistics,
            'total_income' => number_format($totalIncome, 2), // Format total income as decimal
            'total_outcome' => number_format($totalOutcome, 2), // Format total outcome as decimal
        ];

        // Return the statistics data as a JSON response
        return response()->json($response, 200);

    } catch (\Exception $e) {
        // Log any exception messages
        \Log::error('Error generating account statistics: ' . $e->getMessage());

        return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    }
}


}
