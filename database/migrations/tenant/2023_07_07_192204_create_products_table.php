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
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('product_sku')->nullable();
            $table->integer('model_no')->nullable();
            $table->integer('barcode')->nullable();
            $table->integer('manage_inventory')->nullable();
//            $table->integer('product_qty')->nullable();
            $table->string('product_types')->nullable();
            $table->integer('cost_price')->nullable();
            $table->integer('selling_price')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('product_category')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('head_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('weight')->default(0);
            $table->integer('supplier_id')->nullable();

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
