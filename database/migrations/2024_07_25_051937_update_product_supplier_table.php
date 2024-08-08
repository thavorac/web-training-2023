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
        Schema::table('product_supplier', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['supplier_id']);
            
            // Re-add the foreign key constraint with ON DELETE CASCADE
            $table->foreign('supplier_id')
                  ->references('id')
                  ->on('suppliers')
                  ->onDelete('cascade');

            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('product_supplier', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['supplier_id']);
            
            // Re-add the foreign key constraint with a different delete rule (if needed)
            $table->foreign('supplier_id')
                  ->references('id')
                  ->on('suppliers')
                  ->onDelete('restrict'); // or any other rule that was previously used
        });
    }
     
    
};
