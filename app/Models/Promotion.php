<?php
// Promotion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['discount_percentage', 'start_date', 'end_date', 'status'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_promotion')->withPivot('discount_price');
    }

    protected $casts = [
        'status' => 'boolean',
    ];
}
