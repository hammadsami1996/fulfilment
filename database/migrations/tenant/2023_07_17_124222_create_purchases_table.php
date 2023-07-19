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
            $table->integer('supplier_id');
            $table->integer('po_number');
            $table->integer('po_reference_number');
            $table->dateTime('po_date');
            $table->dateTime('due_date');
            $table->integer('discount');
            $table->string('sku');
            $table->string('name');
            $table->integer('qty');
            $table->integer('purchasing_price');
            $table->integer('tax');
            $table->integer('sub_total');
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
