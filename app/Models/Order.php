<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongTo(User::class);
    }
    public function products(){
        return $this->belongsToMany(products::class)->withPivot('quantity');
    }

}
