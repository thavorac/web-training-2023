<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillabl = ['order_number','status'];
    public function orders():HasMany
    {
        return $this->hasMany(Order::class);

    }

}
