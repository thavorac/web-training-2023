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
            $talbe->double('discount')->nullable();
            $talbe->string('tags')->nullable();
            $table->timestamp('promotion_date')->nullable();
            $table->string('color');
            $talbe->integer('rating')->default(0);
            $table->int('purchased_num')->default(0);
            $table->string('size');
            $table->string('brand')->default(0);
            $table->string('style');
            $table->string('model');
            $table->string('shipping');
            $table->timestamps();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
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
