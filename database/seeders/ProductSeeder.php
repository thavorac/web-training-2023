<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('products')->insert([
        //     'name' => ' New clothing',
        //     'category-id'=> 2,
        //     'pricing'=> '15.5$',
        //     'discount'=> '5%',
        //     'tage'=> 'tage 1',
        //     'promotion_date'=> 'two day',
        //     'color'=> 'red',
        //     'rating'=> 5,
        //     'purchased_num'=> 2,
        //     'size'=>'S',
        //     'brand'=> 'Sudo',
        //     'style'=>'sexy',
        //     'model'=>'dress',
        //     'shipping'=>'Grap',
        //     'supplier_id'=> 1,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        DB::table('products')->insert([
            'name' => 'New clothing',
            'category_id' => 1,
            'pricing' => 12,
            'discount' => 4,
            'tags' => 'dfg',
            'promotion_date' => now(),
            'color' => 'red',
            'rating' => 5,
            'purchased_num' => 2,
            'size' => 'S',
            'brand' => 'Sudo',
            'style' => 'sexy',
            'model' => 'dress',
            'shipping' => 'Grap',
            'supplier_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
    }
}
