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
            $table->integer('supplier_id')->nullable();
            $table->string('po_number')->nullable();
            $table->integer('po_reference_number')->nullable();
            $table->dateTime('po_date')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->integer('discount')->nullable();
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('purchasing_price')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('sub_total')->nullable();
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
