<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndQtyToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
             $table->boolean('status')->default(1)->after('size'); // Default to 1 (in stock)
             $table->integer('qty')->default(0)->after('pricing'); // Defaulpt to 0
            $table->double('origin_price')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // $table->dropColumn('status');
            // $table->dropColumn('qty');
            $table->dropColumn('origin_price');
        });
    }
}

