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
            $table->longText('master_remarks')->nullable();
            $table->integer('reference_no')->nullable();
            $table->date('voucher_date')->nullable();
            $table->integer('finance_transaction_master_id')->nullable();
            $table->decimal('debit', 10, 2)->default(0);
            $table->decimal('credit', 10, 2)->default(0);    
            $table->integer('account_id')->nullable();
            $table->string('account_title')->nullable();
            // $table->string('subledger_type')->nullable();
            // $table->string('subledger_code')->nullable();
            // $table->integer('subledger_id')->nullable();
            $table->string('contra_account_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('vid')->nullable();
            $table->integer('did')->nullable();
            $table->longText('detail_remarks')->nullable();
            $table->decimal('rate', 10, 2)->default(0);
            $table->decimal('fc_debit', 10, 2)->default(0);
            $table->decimal('fc_credit', 10, 2)->default(0);
            $table->bigInteger('serial')->nullable();
            $table->integer('cost_center_id')->nullable();

            $table->integer('currency_id')->nullable();
            $table->string('cost_center_name')->nullable();
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
        Schema::dropIfExists('finance_transactions');
    }
};
