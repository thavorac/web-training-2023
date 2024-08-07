<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type_Tran', ['income', 'outcome']);
            $table->decimal('balance', 10, 2)->default(0);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->bigInteger('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->bigInteger('product_id')->unsigned()->nullable(); // Optional: Add this line
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null'); // Optional: Add this line
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
