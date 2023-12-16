<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('pricing');
            $talbe->double('discount');
            $talbe->string('tags');
            $table->timestamp('promotion_date');
            $table->string('color');
            $talbe->integer('rating');
            $table->int('purchased_num');
            $table->string('size');
            $table->string('brand');
            $table->string('style');
            $table->string('model');
            $table->string('shipping');
            $table->timestamps();

            $table->bigInteger('category_id') ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
