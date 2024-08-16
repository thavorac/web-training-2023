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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type_Tran', ['income', 'outcome']);
            $table->decimal('balance', 10, 2)->default(0);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('accounts');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
