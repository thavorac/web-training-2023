<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'pricing', 'discount','color','category_id','image'
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

    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class, 'product_promotion')
                    ->withPivot('discount_price')
                    ->withTimestamps();
    }

    public function applyDiscount()
    {
        $activePromotion = $this->promotions()
                                ->where('start_date', '<=', Carbon::now())
                                ->where('end_date', '>=', Carbon::now())
                                ->first();

        if ($activePromotion) {
            if ($activePromotion->discount_percentage) {
                $discountedPrice = $this->price - ($this->price * ($activePromotion->discount_percentage / 100));
            } else {
                // Handle fixed discount if implemented
                $discountedPrice = $this->price; 
            }
            $this->update(['discounted_price' => $discountedPrice]);
        } else {
            $this->update(['discounted_price' => null]);
        }
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
