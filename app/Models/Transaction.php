<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id', 
        'type_Tran', 
        'balance', 
        'description',
        'recipe_id', 
        'purchase_id'
    ];
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
     // Relationship with Order
     public function order()
     {
         return $this->belongsTo(Order::class);
     }
 
     // Relationship with Purchase
     public function purchase()
     {
         return $this->belongsTo(Purchase::class);
     }
     public function recipe()
     {
         return $this->belongsTo(Recipe::class);
     }
   
}
