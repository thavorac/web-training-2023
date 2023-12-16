<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// 
use Illuminate\Support\Facades\DB;
use App\Models\Product; // Add this line to import the Product model
use Illuminate\Database\Eloquent\Factories\Factory; // Add this line to import the factory function
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
            'name' => 'Test User',
            'pricing' => '100$',
            'discount' => '10%',
            'tags' => 'modern',
            'promotion_date' => '3day',
            'color' => 'red',
            'rating' => '4',
            'purchased_num' => '2',
            'size' => 'M',
            'brand' => 'zendo',
            'style' => 'asia',
            'model' => 'zana',
            'shipping'=> 'china',
            'category_id' => 1, // Replace with the actual category ID
            'supplier_id' => 1, // Replace with the actual supplier ID
            'created_at' => now(),
            'updated_at' => now(),
         ]);

    }
}