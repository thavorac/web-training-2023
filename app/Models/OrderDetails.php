<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
    ];

    // Define relationships if needed
}
