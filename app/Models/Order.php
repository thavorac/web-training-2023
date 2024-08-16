<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
    ];

    /**
     * Get all of the cartItems for the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function OrderProduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
    // 
      protected static function booted()
    {
        static::created(function ($order) {
            // Find the account with 'main' default type
            $account = Account::where('default', 'main')->first();


            if ($account) {
                // Use the total order value as the balance
                $balance = $order->total;

                // Update the account balance
                $account->balance += $balance;
                $account->save();

                // Create a transaction based on the total order amount
                Transaction::create([
                    'account_id' => $account->id, // Use the dynamically found account ID
                    'type_Tran' => 'income',
                    'balance' => $balance,
                    'description' => 'Order ID: ' . $order->id,
                    // 'product_id' is omitted because we are not using OrderProduct
                ]);
            } else {
                // Handle the case where no default 'main' account is found
                \Log::warning('No account with default type "main" found.');
            }
        });
    }
 
}
