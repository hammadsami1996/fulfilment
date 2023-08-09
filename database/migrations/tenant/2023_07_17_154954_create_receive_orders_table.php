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
        Schema::create('receive_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('purchase_order_id')->nullable();
            $table->string('number')->nullable();
            $table->integer('status_id')->nullable();


            $table->string('document')->nullable();
            $table->string('note')->nullable();
            $table->string('reference')->nullable();
            $table->string('po_number')->nullable();
            $table->timestamp('po_date')->nullable();




            // $table->integer('total')->nullable();
            // $table->integer('tax')->nullable();
            // $table->integer('balance')->nullable();
            // $table->string('courier')->nullable();
            // $table->integer('payment_status')->nullable();
            // $table->string('location')->nullable();
            // $table->string('sales_rep')->nullable();
            // $table->integer('selling_price')->nullable();
            // $table->integer('external_order_no')->nullable();
            // $table->integer('tracking_id')->nullable();
            // $table->integer('product_id')->nullable();
            // $table->decimal('subTotal')->nullable();
            // $table->decimal('discount')->nullable();
            // $table->decimal('discount_percent')->nullable();
            // $table->integer('wearhouse_id')->nullable();
           
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receive_orders');
    }
};
