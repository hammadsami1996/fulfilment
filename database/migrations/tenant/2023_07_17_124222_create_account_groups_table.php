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
        Schema::create('account_groups', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('groupname')->nullable();
        

            
            $table->integer('class_id', 8)->nullable();
            $table->integer('active', 8)->nullable();
            $table->integer('company_id', 8)->nullable();
           
            $table->double('debit', 15, 2)->nullable();
            $table->double('credit', 15, 2)->nullable();
            $table->double('balance', 15, 2)->nullable();
            $table->double('account_period_opening', 15, 2)->nullable();
          

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_groups');
    }
};
