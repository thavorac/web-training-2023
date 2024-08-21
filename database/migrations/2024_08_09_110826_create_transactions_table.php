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

            // Foreign key columns
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('recipe_id')->nullable();
            $table->unsignedBigInteger('purchase_id')->nullable();

            // Foreign key constraints
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('set null');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('set null');
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
