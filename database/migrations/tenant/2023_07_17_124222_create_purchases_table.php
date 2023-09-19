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
            $table->string('po_number',25)->nullable();
            $table->integer('po_reference_number')->nullable();
            $table->date('po_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('discount')->nullable();
            $table->string('sku',25)->nullable();
            $table->string('name',25)->nullable();
            $table->integer('qty')->nullable();
            $table->integer('purchasing_price')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('sub_total')->nullable();
            $table->string('discount_percent',25)->nullable();
            $table->integer('total')->nullable();
            $table->integer('status_id')->default(23);
            $table->integer('partial_remaining')->nullable();



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
