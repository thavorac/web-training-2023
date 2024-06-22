<?php
// Promotion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['name', 'discount_percentage', 'discount_amount', 'start_date', 'end_date', 'status', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_product')
                    ->withPivot('discount_price')
                    ->withTimestamps();
    }
}
