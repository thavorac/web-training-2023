<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'pricing', 'discount','color','size','brand','category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);  // if we want to find that product belong to which category 
    }
    public function images(){
        return $this->hasMany(Image::class,'product_id','id');
    }

    // add new code 
    public function firstImage()
    {
        return $this->hasOne(Image::class)->oldestOfMany();
    }


    // Add this method to format dates
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_product')
                    ->withPivot('discount_price')
                    ->withTimestamps();
    }

    public function getCurrentPromotion()
    {
        return $this->promotions()->where('start_date', '<=', now())
                                   ->where('end_date', '>=', now())
                                   ->first();
    }

    public function getDiscountedPriceAttribute()
    {
        $promotion = $this->getCurrentPromotion();
        if ($promotion) {
            return $promotion->pivot->discount_price ?? $this->calculateDiscountedPrice($promotion);
        }
        return $this->price;
    }

    private function calculateDiscountedPrice($promotion)
    {
        if ($promotion->discount_amount) {
            return $this->price - $promotion->discount_amount;
        } elseif ($promotion->discount_percentage) {
            return $this->price * (1 - $promotion->discount_percentage / 100);
        }
        return $this->price;
    }
}
