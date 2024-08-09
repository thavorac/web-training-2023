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
        'order_id', 
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    
    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class, 'order_id');
    }
}
