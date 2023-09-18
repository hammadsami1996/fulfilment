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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id', 15)->nullable();
            $table->string('po_number',25)->nullable();
            $table->integer('po_reference_number',15)->nullable();
            $table->date('po_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('discount',15)->nullable();
            $table->string('sku',25)->nullable();
            $table->string('name',25)->nullable();
            $table->integer('qty',15)->nullable();
            $table->integer('purchasing_price',15)->nullable();
            $table->integer('tax',15)->nullable();
            $table->integer('sub_total',15)->nullable();
            $table->string('discount_percent',25)->nullable();
            $table->integer('total',15)->nullable();
            $table->integer('status_id')->default(23);
            $table->integer('partial_remaining',15)->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
