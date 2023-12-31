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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25)->nullable();
            $table->string('location',25)->nullable();
            $table->string('store_type', 25)->nullable();
            $table->string('plate_form',25)->nullable();
            $table->string('img')->nullable();
            $table->string('access_token',50)->nullable();
            $table->string('store_address',50)->nullable();
            $table->string('api_key',50)->nullable();
            $table->string('api_secret',50)->nullable();
            $table->string('word_address',50)->nullable();
            $table->integer('company_id')->nullable();
            $table->string('mim_api_key',100)->nullable();
            $table->string('mim_store_address',100)->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('fetch_order')->nullable()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
