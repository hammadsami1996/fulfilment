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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('store')->nullable();
            $table->timestamp('order_date')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('city')->nullable();
            $table->integer('total')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('balance')->nullable();
            $table->string('courier')->nullable();
            $table->integer('payment_status')->nullable();
            $table->string('location')->nullable();
            $table->string('sales_rep')->nullable();
            $table->integer('selling_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
