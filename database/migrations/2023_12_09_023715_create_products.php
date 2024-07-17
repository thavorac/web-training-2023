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
            $table->double('discount')->nullable();
            $table->string('tags')->nullable();
<<<<<<< HEAD
            $table->timestamp('promotion_date')->nullable();
=======
>>>>>>> 15da5c16a21062cb8f7353d52d3c45291afcdc7f
            $table->string('color')->nullable();
            $table->integer('rating')->default(0);
            $table->integer('purchased_num')->default(0);
            $table->string('size')->nullable();
            $table->string('brand')->nullable();
<<<<<<< HEAD
=======
            $table->string('image');
>>>>>>> 15da5c16a21062cb8f7353d52d3c45291afcdc7f
            $table->string('style')->nullable();
            $table->string('model')->nullable();
            $table->string('shipping')->nullable();
            $table->string('description');
<<<<<<< HEAD
            $table->string('image');
=======
>>>>>>> 15da5c16a21062cb8f7353d52d3c45291afcdc7f
            $table->timestamps();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
<<<<<<< HEAD
            
            // $table->bigInteger('category_id')->unsigned()->nullable();
            // $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();

            // $table->bigInteger('supplier_id')->unsigned();
            // $table->foreign('supplier_id')->references('id')->on('suppliers');
=======
>>>>>>> 15da5c16a21062cb8f7353d52d3c45291afcdc7f
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
