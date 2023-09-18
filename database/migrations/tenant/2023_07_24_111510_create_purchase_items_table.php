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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('unit_price',10)->nullable();
            $table->decimal('value_ex_tax',10)->nullable();
            $table->decimal('tax_percent',10)->nullable();
            $table->decimal('tax_amount',10)->nullable();
            $table->decimal('value_inc_tax',10)->nullable();
            $table->integer('partail_remaining')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
