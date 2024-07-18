<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'pricing', 'discounted_price', 'color', 'category_id', 'image', 'description'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function firstImage()
    {
        return $this->hasOne(Image::class)->oldestOfMany();
    }

    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class, 'product_promotion')->withTimestamps();
    }

    public function applyDiscount()
{
    $activePromotion = $this->promotions()
                            ->where('start_date', '<=', Carbon::now())
                            ->where('end_date', '>=', Carbon::now())
                            ->first();
    
    if ($activePromotion) {
        Log::info('Active promotion found', ['promotion' => $activePromotion->toArray()]);
        
        $discountedPrice = $this->pricing; // Initialize with original price

        if ($activePromotion->discount_percentage > 0) {
            $discountedPrice = $this->pricing - ($this->pricing * ($activePromotion->discount_percentage / 100));
            Log::info('Discounted price calculated', ['pricing' => $this->pricing, 'discount_percentage' => $activePromotion->discount_percentage, 'discounted_price' => $discountedPrice]);
        }

        // Update the product's discounted price
        $this->update(['discounted_price' => $discountedPrice]);
    } else {
        // No active promotion, set discounted price to null or original price as needed
        $this->update(['discounted_price' => $this->pricing]);
    }
}


    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
