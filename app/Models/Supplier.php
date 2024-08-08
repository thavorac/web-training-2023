<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name' ,'company','address' , 'phone' , 'email','item','gender' ];  
    
    // Define the relationship with products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_supplier');
    }


}
