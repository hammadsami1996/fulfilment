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
            $table->string('title', 50)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('product_sku', 25)->nullable();
            $table->string('model_no', 25)->nullable();
            $table->string('barcode', 25)->nullable();
            $table->string('manage_inventory', 25)->nullable();
            // $table->integer('product_qty')->nullable();
            $table->string('product_types', 25)->nullable();
            $table->string('cost_price', 25)->nullable();
            $table->string('selling_price', 25)->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('product_category', 25)->nullable();
            $table->integer('brand_id', 8)->nullable();
            $table->integer('head_id', 8)->nullable();
            $table->string('quantity', 25)->nullable();
            $table->integer('weight', 8)->default(0);
            $table->integer('supplier_id', 8)->nullable();

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
