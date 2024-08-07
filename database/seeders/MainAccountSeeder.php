<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class MainAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the main account only if it doesn't exist
        if (Account::where('type', 'main')->doesntExist()) {
            Account::create([
                'name' => 'Main Account',
                'type' => 'main', // Assuming 'main' is a valid type for the main account
                'balance' => 10000, // Initial balance
            ]);
        }
    }
}
