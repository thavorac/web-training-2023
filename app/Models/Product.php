<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillabl = ["name", "price","category_id"];
    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
    // public function category(): BelongsTo 
    // {
    //     return $this->
    // }
}
