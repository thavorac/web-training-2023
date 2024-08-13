<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table='orders_product';
    

    protected $fillable = [
        'order_id',
        'product_id', 
        'pricing', 
        'quantity', 
        'discounted_price'
    ];

    /**
     * Get the product associated with the cart item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    // protected static function booted()
    // {
    //     static::created(function ($orderProduct) {
    //         // Assuming account ID 2 is used for recording transactions
    //         $account = Account::find(2); // or use appropriate logic to get the correct account

    //         // Calculate the balance
    //         $balance = $orderProduct->pricing * $orderProduct->quantity;

    //         // Update the account balance
    //         $account->balance += $balance;
    //         $account->save();

    //         // Create the transaction
    //         Transaction::create([
    //             'account_id' => 2,
    //             'type_Tran' => 'income',
    //             'balance' => $balance,
    //             'description' => 'Product sold: ' . $orderProduct->product->name . ' x ' . $orderProduct->quantity,
    //             'product_id' => $orderProduct->product_id
    //         ]);
    //     });
    // }
    protected static function booted()
{
    static::created(function ($orderProduct) {
        // Find the account with 'sale' default type
        $account = Account::where('default', 'main')->first();

        if ($account) {
            // Calculate the balance
            $balance = $orderProduct->pricing * $orderProduct->quantity;

            // Update the account balance
            $account->balance += $balance;
            $account->save();

            // Create the transaction
            Transaction::create([
                'account_id' => $account->id, // Use the dynamically found account ID
                'type_Tran' => 'income',
                'balance' => $balance,
                'description' => 'Product sold: ' . $orderProduct->product->name . ' x ' . $orderProduct->quantity,
                'product_id' => $orderProduct->product_id
            ]);
        } else {
            // Handle the case where no default sale account is found
            \Log::warning('No account with default type "sale" found.');
        }
    });
}

}
