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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->integer('phone')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('balance')->nullable();
            $table->string('type_id')->nullable();
            $table->string('address')->nullable();
            $table->integer('b_country_id')->nullable();
            $table->integer('s_country_id')->nullable();
            $table->integer('b_city_id')->nullable();
            $table->integer('s_city_id')->nullable();
            $table->integer('number')->nullable();
            $table->decimal('cnic')->nullable();
            $table->string('b_name')->nullable();
            $table->string('b_phone')->nullable();
            $table->string('b_address_1')->nullable();
            $table->string('b_address_2')->nullable();
            $table->string('s_name')->nullable();
            $table->string('s_phone')->nullable();
            $table->string('s_address_1')->nullable();
            $table->string('s_address_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
