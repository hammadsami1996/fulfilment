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
        Schema::create('finance_transaction_masters', function (Blueprint $table) {
            $table->id();
            // $table->integer('account_id')->nullable();
            // $table->integer('finance_transaction_id')->nullable();
            $table->string('voucher_type')->nullable();
            $table->string('voucher_number')->nullable();
            $table->longText('detail_remarks')->nullable();
            $table->integer('reference_no')->nullable();
            // $table->integer('subledger_id')->nullable();
            $table->date('voucher_date')->nullable();
            $table->decimal('debit', 10, 2)->default(0);
            $table->decimal('credit', 10, 2)->default(0);
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
        Schema::dropIfExists('finance_transaction_masters');
    }
};
