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
        Schema::create('finance_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_type')->nullable();
            $table->string('voucher_number')->nullable();
            $table->string('account_title')->nullable();
            $table->string('subledger_type')->nullable();
            $table->string('subledger_code')->nullable();
            $table->string('contra_account_id')->nullable();
            $table->longText('detail_remarks')->nullable();
            $table->longText('master_remarks')->nullable();





            $table->date('voucher_date')->nullable();
            
            $table->integer('vid')->nullable();
            $table->integer('did')->nullable();
            $table->integer('account_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('subledger_id')->nullable();
            $table->double('rate', 13, 2)->nullable();
            $table->double('fc_debit', 0, 0)->nullable();
            $table->double('fc_credit', 0, 0)->nullable();
            $table->double('debit', 13, 2)->nullable();
            $table->double('credit', 13, 2)->nullable();
            $table->bigInteger('serial')->nullable();
            $table->integer('cost_center_id')->nullable();

            $table->integer('currency_id')->nullable();
            $table->string('cost_center_name')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_transactions');
    }
};
