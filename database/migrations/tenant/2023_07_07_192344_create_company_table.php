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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',25)->nullable();
            $table->string('net_total',20)->nullable();
            $table->string('phone',20)->nullable();
            $table->integer('tax_number')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('postal',25)->nullable();
            $table->string('province',25)->nullable();
            $table->string('address')->nullable();
            $table->string('logo',25)->nullable();
            $table->string('email',25)->nullable();
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
        Schema::dropIfExists('company');
    }
};
