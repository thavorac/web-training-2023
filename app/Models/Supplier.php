<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillabl = ['name','address','phone','email'];
    public function Suppliers():HasMany
    {
        return $this->hasMany(Supplier::class);
    }
}
