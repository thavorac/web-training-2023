<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Recipe;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
    ];

    /**
     * Get all of the cartItems for the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function OrderProduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function recipe(){
        return $this->hasOne(Recipe::class);
    }
}
