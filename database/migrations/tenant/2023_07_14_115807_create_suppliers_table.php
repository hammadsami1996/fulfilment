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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 30)->nullable();
            $table->string('company_name' , 30)->nullable();
            $table->string('website' , 100)->nullable();
            $table->string('address')->nullable();
            $table->string('number_1' , 15)->nullable();
            $table->string('number_2' , 15)->nullable();
            $table->string('email',  30 )->nullable();
            $table->string('opening_balance' , 15)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};
