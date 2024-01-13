<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];  // mas assignment ( like id we don't need to save show we use  mas assignment to set array that we want to save )

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    } // this products() function mean that 1 category hasMany products inside it


    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class);  // if we want to find that product belong to which category 
    // }
}
