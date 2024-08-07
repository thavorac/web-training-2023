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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('qty')->default(1);
            $table->decimal('total_price')->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->bigInteger('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('purchases');

            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
        
            // $table->foreignId('supplier_id')->constrained();
    }
};
