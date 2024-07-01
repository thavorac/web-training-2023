<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promotion extends Model
{
    protected $fillable = [
        'name', 'description', 'discount_percentage', 'start_date', 'end_date', 'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_promotion')
                    ->withPivot('discount_price')
                    ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)
                     ->where('start_date', '<=', Carbon::now())
                     ->where('end_date', '>=', Carbon::now());
    }
}
