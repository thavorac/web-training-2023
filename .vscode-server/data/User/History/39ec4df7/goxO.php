<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 products using the factory
        factory(App\Models\Product::class, 10)->create();

        // Manually set values for a specific user (example)
        \App\Models\User::create([
            'name' => 'Test user',
            'email' => 'test@gmail.com',
        ]);
    }
}
