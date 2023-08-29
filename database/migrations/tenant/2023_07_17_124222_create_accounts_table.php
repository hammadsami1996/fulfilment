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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('accounttitle')->nullable();
            $table->string('short')->nullable();
            $table->string('accountcode')->nullable();

            
            $table->integer('nature')->nullable();
            $table->integer('level')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('head_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('accept_payment')->nullable();
            $table->integer('active')->nullable();
            $table->decimal('opening_balance', 11, 2)->nullable();
            $table->integer('opening_type')->nullable();
            $table->integer('gain_loss_on_exchange')->nullable();
            $table->decimal('rate', 11, 2)->nullable();
            $table->integer('currency_id')->nullable();
            $table->decimal('budget', 11, 2)->nullable();
            $table->integer('gain_loss_on_exch_account_id')->nullable();
            $table->string('description')->nullable();
            $table->integer('report_group')->nullable();

            $table->date('op_date')->nullable();
            $table->decimal('op_debit', 14, 2)->nullable();
            $table->decimal('op_credit', 14, 2)->nullable();
            $table->integer('company_id')->nullable();
            $table->double('debit', 15, 2)->nullable();
            $table->double('credit', 15, 2)->nullable();
            $table->double('balance', 15, 2)->nullable();
            $table->double('account_period_opening', 15, 2)->nullable();
            $table->integer('voucher_type_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
