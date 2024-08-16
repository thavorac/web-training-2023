<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty', 'total_price','supplier_id','product_id','status'
    ];
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
    public function product(): BelongsTo
{
    return $this->belongsTo(Product::class);
}
// protected static function booted()
// {
//     static::created(function ($purchase) {
//         try {
//             // Find the account with 'buy' default type
//             $account = Account::where('default', 'buy')->first();

//             if ($account) {
//                 // Calculate the balance
//                 $balance = $purchase->total_price;

//                 // Update the account balance
//                 $account->balance += $balance;
//                 $account->save();

//                 // Create the transaction even if the product is not found
//                 $description = 'Product purchased';
//                 if ($purchase->product) {
//                     $description .= ': ' . $purchase->product->name . ' x ' . $purchase->qty;
//                 } else {
//                     $description .= ' (Product not found)';
//                 }

//                 Transaction::create([
//                     'account_id' => $account->id,
//                     'type_Tran' => 'outcome',
//                     'balance' => $balance,
//                     'description' => $description,
//                     'product_id' => $purchase->product_id
//                 ]);
//             } else {
//                 \Log::warning('No account with default type "buy" found.');
//             }
//         } catch (\Exception $e) {
//             \Log::error('Error creating transaction for purchase ID ' . $purchase->id . ': ' . $e->getMessage());
//         }
//     });
// }
protected static function booted()
{
    static::created(function ($purchase) {
        try {
            // Find the account with 'buy' default type
            $account = Account::where('default', 'buy')->first();

            if ($account) {
                // Calculate the total balance from the purchase
                $totalBalance = $purchase->total_price;

                // Update the account balance
                $account->balance += $totalBalance;
                $account->save();

                // Create a single transaction for the purchase
                $description = 'Product purchased';
                if ($purchase->products->count()) {
                    $description .= ': ' . $purchase->products->pluck('name')->implode(', ');
                } else {
                    $description .= ' (Products not found)';
                }

                // Create the transaction
                Transaction::create([
                    'account_id' => $account->id,
                    'type_Tran' => 'outcome',
                    'balance' => $totalBalance,
                    'description' => $description,
                    'purchase_id' => $purchase->id // If you want to link the transaction to the purchase
                ]);
            } else {
                \Log::warning('No account with default type "buy" found.');
            }
        } catch (\Exception $e) {
            \Log::error('Error creating transaction for purchase ID ' . $purchase->id . ': ' . $e->getMessage());
        }
    });
}



}
