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
            $table->string('po_reference_number',15)->nullable();
            $table->date('po_date')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('discount',10,2)->default(0);
            $table->string('sku',25)->nullable();
            $table->string('name',25)->nullable();
            $table->integer('qty')->nullable()->default(0);
            $table->decimal('purchasing_price',10,2)->default(0);
            $table->decimal('tax',10,2)->default(0);
            $table->decimal('sub_total',10,2)->default(0);
            $table->string('discount_percent',25)->nullable();
            $table->decimal('total',10,2)->default(0);
            $table->integer('status_id')->default(23);
            $table->decimal('partial_remaining',10,2)->default(0);
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
        Schema::dropIfExists('purchases');
    }
};
