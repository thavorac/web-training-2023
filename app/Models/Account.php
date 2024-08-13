<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'default',
        'balance',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique card number when creating a new account
        static::creating(function ($account) {
            $account->card_number = self::generateUniqueCardNumber();
        });
    }

    private static function generateUniqueCardNumber()
    {
        do {
            // Generate a 16-digit card number
            $cardNumber = sprintf('%04d %04d %04d %04d', mt_rand(1000, 9999), mt_rand(1000, 9999), mt_rand(1000, 9999), mt_rand(1000, 9999));
        } while (self::where('card_number', $cardNumber)->exists());

        return $cardNumber;
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
