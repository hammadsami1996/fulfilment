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
        Schema::create('voucher_items', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->nullable();
            $table->integer('voucher_id')->nullable();
            $table->integer('subledger_id')->nullable();
            $table->decimal('debit',10,2)->nullable()->default(0.00);
            $table->decimal('credit',10,2)->nullable()->default(0.00);
            $table->string('reference', 15)->nullable();
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
        Schema::dropIfExists('voucher_items');
    }
};
