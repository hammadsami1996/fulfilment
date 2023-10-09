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
            $table->string('name' , 100)->nullable();
            $table->string('email' , 50)->nullable();
            $table->string('phone' , 20)->nullable();
            $table->integer('category_id')->nullable();
            // $table->integer('balance')->nullable();
            // $table->string('type_id', 15)->nullable();
            $table->string('address')->nullable();
            $table->integer('b_country_id')->nullable();
            $table->integer('s_country_id')->nullable();
            $table->integer('b_city_id')->nullable();
            $table->integer('s_city_id')->nullable();
            $table->integer('number')->nullable();
            $table->string('cnic' , 30)->nullable();
            $table->string('b_name' , 50)->nullable();
            $table->string('b_phone' , 20)->nullable();
            $table->string('b_address_1')->nullable();
            $table->string('s_name' , 50)->nullable();
            $table->string('s_phone' , 20)->nullable();
            $table->string('s_address_1')->nullable();
            $table->date('date')->nullable();
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
