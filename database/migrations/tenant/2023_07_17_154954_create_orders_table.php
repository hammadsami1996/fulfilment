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
            $table->integer('company_id')->nullable();
            $table->string('city_id')->nullable();
            $table->decimal('total',10,2)->default(0);
            $table->decimal('tax',10,2)->default(0);
            $table->decimal('balance',10,2)->nullable()->default(0);
            $table->string('courier')->nullable();
            $table->integer('courier_id')->nullable();
            $table->integer('payment_status')->nullable();
            $table->string('location')->nullable();
            $table->string('sales_rep')->nullable();
            $table->decimal('selling_price',10,2)->nullable()->default(0);
            $table->string('external_order_no', 50)->nullable();
            $table->string('tracking_id' , 50)->nullable();
            $table->integer('product_id')->nullable();
            $table->decimal('subTotal',10,2)->nullable()->default(0);
            $table->decimal('discount',10,2)->nullable()->default(0);
            $table->decimal('discount_percent',10,2)->nullable()->default(0);
            $table->integer('warehouse_id')->nullable();
            $table->integer('status_id')->default(1);
            $table->string('so_number' , 30)->nullable();
            $table->string('s_name', 50)->nullable();
            $table->string('s_email' , 50)->nullable();
            $table->string('s_address_1')->nullable();
            $table->string('s_phone' , 20)->nullable();
            $table->string('b_name', 50)->nullable();
            $table->string('b_email' , 50)->nullable();
            $table->string('b_address_1')->nullable();
            $table->string('b_phone' , 20)->nullable();
            $table->string('instraction', 100)->nullable();
            $table->decimal('quantity',10,2)->default(0);
            $table->integer('order_type_id')->nullable();
            $table->decimal('shipping_charges',10,2)->nullable()->default(0);
            $table->decimal('advance',10,2)->default(0);
            $table->decimal('delivery_charges',10,2)->default(0);
            $table->integer('shipped_by_id')->nullable();
            $table->decimal('weight',10,2)->nullable()->default(0);
            $table->string('order_form', 30)->nullable();
            $table->string('payment_method', 30)->nullable();
            $table->string('item_summary')->nullable();
            $table->string('item_summary_mannual')->nullable();
            $table->string('coupons')->nullable();
            $table->decimal('coupons_discount')->nullable()->default(0);
            $table->decimal('redeem_amount',10,2)->nullable()->default(0);
            $table->decimal('net_total',10,2)->nullable()->default(0);
            $table->string('comments')->nullable();
            $table->integer('shipment_services')->nullable();
            $table->string('shipped_ref')->nullable();
            $table->string('shipper_slip_link')->nullable();
            $table->string('city_name')->nullable();
            $table->string('payment_description')->nullable();
            $table->integer('currency_id')->nullable();
            $table->string('currency_symbol',10)->nullable();
            $table->decimal('currency_value',10,2)->nullable()->default(0);
            $table->string('replacement_item_summary')->nullable();
            $table->decimal('replacement_qty',10,2)->nullable()->default(0);
            // $table->timestamp('created_at')->nullable();
            // $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
