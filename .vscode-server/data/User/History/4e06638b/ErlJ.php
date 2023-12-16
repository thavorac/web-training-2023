<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
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
            'name' => Str::random(10),
            'pricing' => Str::random(10),
            'discount' =>Str::random(10),
            'tags' => Str::random(10) 
         ])
    }
}
