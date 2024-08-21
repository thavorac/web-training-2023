<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected static function booted()
    {
        static::created(function ($recipe) {
            $account = Account::where('default', 'main')->first();
            
            if ($account) {
                $order = $recipe->order;
                // Determine the balance value you want to add.
                // You may need to calculate this based on order details.
                $balance = $order->total;

                // Update the account balance
                $account->balance += $balance;
                $account->save();

                Transaction::create([
                    'account_id' => $account->id,
                    'type_Tran' => 'income',
                    'balance' => $balance,
                    'description' => 'Recipe ID: ' . $recipe->id,
                    'recipe_id' => $recipe->id,
                    // 'product_id' is omitted because we are not using OrderProduct
                ]);
            } else {
                // Handle the case where no default 'main' account is found
                Log::warning('No account with default type "main" found.');
            }
        });
    }
}
