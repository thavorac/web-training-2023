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
            $table->double('discount')->nullable;
            $table->string('tags')->nullable;
            $table->timestamp('promotion_date')->nullable;
            $table->string('color');
            $table->integer('rating')->default;
            $table->integer('purschased_num')->default;
            $table->string('size');
            $table->string('brand')->default;
            $table->string('style');
            $table->string('model')->nullable;
            $table->string('shipping')->nullable;
            $table->timestamps();


            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');//forengkey and from categoies table

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
