<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'name' => 'Main Account',
            'type' => 'main',
            'balance' => 10000.00, // Initial balance for the main account
        ]);
    }
}
