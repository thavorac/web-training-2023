<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'orders_product';
    protected $fillable = [
        'style',
        'product_id',
        'order_id',
        // Add other attributes here as needed
    ];
}
