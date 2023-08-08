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
        Schema::create('receive_order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('receive_order_id')->nullable();
            $table->integer('purchase_order_item_id')->nullable();

            $table->integer('product_id')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('unit_price')->nullable();
            $table->decimal('value_ex_tax')->nullable();
            $table->decimal('tax_percent')->nullable();
            $table->decimal('tax_amount')->nullable();
            $table->decimal('value_inc_tax')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receive_order_items');
    }
};
