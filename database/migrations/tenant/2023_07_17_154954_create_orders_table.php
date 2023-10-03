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
            $table->integer('store_id')->nullable();
            $table->timestamp('order_date')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('city_id')->nullable();
            $table->integer('total')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('balance')->nullable();
            $table->string('courier')->nullable();
            $table->integer('payment_status')->nullable();
            $table->string('location')->nullable();
            $table->string('sales_rep')->nullable();
            $table->integer('selling_price')->nullable();
            $table->string('external_order_no', 50)->nullable();
            $table->string('tracking_id' , 50)->nullable();
            $table->integer('product_id')->nullable();
            $table->decimal('subTotal')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('discount_percent')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('status_id')->default(1);
            $table->string('so_number' , 30)->nullable();
            $table->string('s_name', 50)->nullable();
            $table->string('s_email' , 50)->nullable();
            $table->string('s_address_1')->nullable();
            $table->string('s_phone' , 20)->nullable();
            $table->string('b_name', 30)->nullable();
            $table->string('b_email' , 50)->nullable();
            $table->string('b_address_1')->nullable();
            $table->string('b_phone' , 20)->nullable();
            $table->string('instraction', 100)->nullable();
            $table->integer('qunatity')->nullable();
            $table->integer('order_type_id')->nullable();
            $table->integer('shipping_charges')->nullable();
            $table->integer('advance')->nullable();
            $table->integer('delivery_charges')->nullable();
            $table->integer('shipped_by_id')->nullable();
            $table->double('weight')->default(0);
            $table->string('order_form' , 30)->nullable();
            $table->string('payment_method' , 30)->nullable();




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
