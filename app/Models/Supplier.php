<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = ['name' ,'company','address' , 'phone' , 'email','item','gender','password' ];  
    
    // Define the relationship with products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_supplier');
    }
    protected $hidden = [
        'password', // Ensure password is hidden in JSON responses
        'remember_token', // Hide the remember token
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

}
