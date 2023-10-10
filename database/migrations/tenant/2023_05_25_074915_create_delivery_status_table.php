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
       Schema::create('delivery_status', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->string('color');
           $table->string('head')->nullable();
           $table->string('head_id')->nullable();
           $table->integer('deleted_by')->nullable();
           $table->timestamp('deleted_at')->nullable();
           $table->timestamps();
       });
        // DB::unprepared(file_get_contents(public_path('/delivery_status.sql')));

        DB::table('delivery_status')->insert(
            [
                'name' => 'Pending',
                'color' => '#F1C40F', 
                'head' => 'order',
                'head_id' => ''
            ]
        );

        DB::table('delivery_status')->insert(
            [
                'name' => 'Confirmed',
                'color' => '#37E784', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Shipped',
                'color' => '#1E91A6', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Delivered',
                'color' => '#438A1A', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Cancelled',
                'color' => '#D33E16', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'On Hold',
                'color' => '#3516D3', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Address Incomplete',
                'color' => '#ECAA36', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Booked',
                'color' => '#85C907', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'CN print',
                'color' => '#D7D42A', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Packed',
                'color' => '#21DCD4', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Dispatch',
                'color' => '#54B01C', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Ready to Ship',
                'color' => '#7A1209', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Not answering calls',
                'color' => '#FEEE02', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Fake',
                'color' => '#FE3B02', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Return Received',
                'color' => '#9E337F', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Return with Courier',
                'color' => '#319B5F', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Message at Whatsapp',
                'color' => '#ADFE17', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Complete',
                'color' => '#035D84', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'In transit',
                'color' => '#BD1482', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Order Merge',
                'color' => '#BD1454', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Review Order',
                'color' => '#066278', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Return-Proof-Need',
                'color' => '#53FDBA', 
                'head' => 'order',
                'head_id' => ''
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Draft',
                'color' => '#30B3A5', 
                'head' => 'purchase',
                'head_id' => '24,26,30'
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Sent',
                'color' => '#53FDBA', 
                'head' => 'purchase',
                'head_id' => '25,26,30'
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Confirmed',
                'color' => '#318E69', 
                'head' => 'purchase',
                'head_id' => '27,26,30'
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Closed',
                'color' => '#F5A912', 
                'head' => 'purchase',
                'head_id' => '24,30'
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Received',
                'color' => '#F5F512', 
                'head' => 'purchase',
                'head_id' => '28,30'
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Bill',
                'color' => '#2B7CB8', 
                'head' => 'purchase',
                'head_id' => '26'
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Partially-Received',
                'color' => '#FCA50E', 
                'head' => 'purchase',
                'head_id' => '27,26,30'
            ]
        );
        DB::table('delivery_status')->insert(
            [
                'name' => 'Cancelled',
                'color' => '#F54212', 
                'head' => 'purchase',
                'head_id' => '24'
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_status');
    }
};
