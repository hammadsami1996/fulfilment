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
            $table->integer('group_id')->nullable();

            
            $table->decimal('nature',10,2)->default(0);
            $table->integer('level')->nullable();
            $table->integer('head_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('accept_payment')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->decimal('opening_balance', 10, 2)->default(0);
            $table->integer('opening_type')->nullable();
            $table->integer('gain_loss_on_exchange')->nullable();
            $table->decimal('rate', 10, 2)->default(0);
            $table->integer('currency_id')->nullable();
            $table->decimal('budget', 10, 2)->default(0);
            $table->integer('gain_loss_on_exch_account_id')->nullable();
            $table->string('description')->nullable();
            $table->decimal('report_group',10,2)->default(0);

            $table->date('op_date')->nullable();
            $table->decimal('op_debit', 10, 2)->default(0);
            $table->decimal('op_credit', 10, 2)->default(0);
            $table->integer('company_id')->nullable();
            $table->decimal('debit', 10, 2)->default(0);
            $table->decimal('credit', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->decimal('account_period_opening', 10, 2)->default(0);
            $table->integer('voucher_type_id')->nullable();
            $table->integer('deleted_by')->nullable();
           $table->timestamp('deleted_at')->nullable();

            $table->timestamps();
        });
        DB::table('accounts')->insert(
            [
                'accounttitle' => 'order sale',
                'accountcode' => '4010010001', 
                'group_id' => 18,
                'active' => 1,
                'description' => 'order account sale'
            ]
        );
        DB::table('accounts')->insert(
            [
                'accounttitle' => 'Trax Saverplus account',
                'accountcode' => '5040010001', 
                'group_id' => 25,
                'active' => 1,
                'description' => 'courier saverplus account'
            ]
        );
        DB::table('accounts')->insert(
            [
                'accounttitle' => 'Leopards Overland account',
                'accountcode' => '5040010002', 
                'group_id' => 25,
                'active' => 1,
                'description' => 'Leopards Overland account'
            ]
        );
        DB::table('accounts')->insert(
            [
                'accounttitle' => 'Rider Overland account',
                'accountcode' => '5040010003', 
                'group_id' => 25,
                'active' => 1,
                'description' => 'Rider Overland account'
            ]
        );
        DB::table('accounts')->insert(
            [
                'accounttitle' => 'Karachi Courier account',
                'accountcode' => '5040010004', 
                'group_id' => 25,
                'active' => 1,
                'description' => 'Karachi Courier account'
            ]
        );
        DB::table('accounts')->insert(
            [
                'accounttitle' => 'Trax Rush account',
                'accountcode' => '5040010005', 
                'group_id' => 25,
                'active' => 1,
                'description' => 'Trax Rush account'
            ]
        );
        DB::table('accounts')->insert(
            [
                'accounttitle' => 'Leopards Overnight account',
                'accountcode' => '5040010006', 
                'group_id' => 25,
                'active' => 1,
                'description' => 'Leopards Overnight  account'
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
