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
        Schema::create('order_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('deleted_by')->nullable();
           $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
        // DB::unprepared(file_get_contents(public_path('/order_types.sql')));
        DB::table('order_types')->insert(
            [
                'name' => 'Facebook',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Twitter',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Instagram',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'WhatsApp',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Call',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'SMS',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Checkout',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'QB-Product',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'QB-Front',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Requested For expired products',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'QB-Product',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Guest Checkout',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Android',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Apple',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Reseller Sale',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Shop Sale',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Daraz Sale',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'iShopping Sales',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Telemart Sales',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Abandoned Cart',
            ]
        );
        DB::table('order_types')->insert(
            [
                'name' => 'Replacement',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_types');
    }
};
