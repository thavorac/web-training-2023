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
            $table->string(column'name');
            $table->bigInteger(column 'category_id');
            $table->double(column:'pricing');
            $talbe->double(column:'discount');
            $talbe->string(column:'tags');
            $table->timestamp(column:'promotion_date');
            $table->string(column:'color');
            $talbe->integer(column:'rating');
            $table->int(column:'purchased_num');
            $table->string(column:'size');
            $table->string(column:'brand');
            $table->string(column:'style');
            $table->string(column:'model');
            $table->string(column:'shipping');
            $table->timestamps();
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
