<?php

namespace App\Models;
use App\Models\Product;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id', 'type_Tran', 'balance', 'description','product_id', 
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
