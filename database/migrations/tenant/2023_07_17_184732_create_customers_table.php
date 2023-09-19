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
            $table->string('name' , 20)->nullable();
            $table->string('email' , 30)->nullable();
            $table->string('phone' , 15)->nullable();
            $table->integer('category_id', 6)->nullable();
            $table->integer('balance', 8)->nullable();
            $table->string('type_id', 15)->nullable();
            $table->string('address')->nullable();
            $table->integer('b_country_id', 8)->nullable();
            $table->integer('s_country_id', 8)->nullable();
            $table->integer('b_city_id', 8)->nullable();
            $table->integer('s_city_id', 8)->nullable();
            $table->integer('number', 12)->nullable();
            $table->string('cnic' , 30)->nullable();
            $table->string('b_name' , 15)->nullable();
            $table->string('b_phone' , 15)->nullable();
            $table->string('b_address_1')->nullable();
            $table->string('b_address_2')->nullable();
            $table->string('s_name' , 15)->nullable();
            $table->string('s_phone' , 15)->nullable();
            $table->string('s_address_1')->nullable();
            $table->string('s_address_2')->nullable();
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
