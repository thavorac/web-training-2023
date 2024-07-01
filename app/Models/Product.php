<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'pricing', 'discount', 'color', 'size', 'brand', 'category_id', 'supplier_id'
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

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

 
}
