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
            $table->integer('store');
            $table->timestamp('order_date');
            $table->integer('customer');
            $table->string('city');
            $table->integer('total');
            $table->integer('tax');
            $table->integer('balance');
            $table->string('courier');
            $table->integer('payment_status');
            $table->string('location');
            $table->string('sales_rep');
            $table->integer('selling_price');
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
