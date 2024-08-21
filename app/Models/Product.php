<?php

namespace App\Models;
// app/Models/Product.php
namespace App\Models;
// namespace App\Models\suppliers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name', 'pricing', 'discounted_price', 'color', 'category_id', 'image', 'description'
    // ];
    protected $fillable = [
        'name', 'pricing', 'discounted_price', 'tags', 'promotion_date', 'color', 
        'rating', 'purchased_num', 'size', 'brand', 'style', 'model', 'shipping', 
        'description', 'image', 'category_id,quantity'
        ,'origin_price', 'discount', 'qty'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    public function firstImage()
    {
        return $this->hasOne(Image::class)->oldestOfMany();
    }
    
    protected static function booted()
    {
        static::retrieved(function ($product) {
            $now = Carbon::now();
            $activePromotion = $product->promotions()
                ->where('start_date', '<=', $now)
                ->where('end_date', '>=', $now)
                ->first();

            if ($activePromotion) {
                $discountedPrice = $product->pricing * (1 - $activePromotion->discount_percentage / 100);
            } else {
                $discountedPrice = 0;
            }

            if ($product->discounted_price != $discountedPrice) {
                $product->update(['discounted_price' => $discountedPrice]);
            }
        });
    }

    // Add the relationship to Promotion in your Product model if not already defined
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, 'product_supplier');
    }

    public function isInStock(): bool
    {
        return $this->qty > 0;
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['is_in_stock'] = $this->isInStock();
        return $array;
    }
    
}
