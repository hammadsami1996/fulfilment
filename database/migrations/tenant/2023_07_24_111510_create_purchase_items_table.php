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
            $table->decimal('qty',10,2)->default(0);
            $table->decimal('unit_price',10,2)->default(0);
            $table->decimal('value_ex_tax',10,2)->default(0);
            $table->decimal('tax_percent',10,2)->default(0);
            $table->decimal('tax_amount',10,2)->default(0);
            $table->decimal('value_inc_tax',10,2)->default(0);
            $table->integer('partail_remaining')->nullable();
            $table->integer('deleted_by')->nullable();
           $table->timestamp('deleted_at')->nullable();

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
