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
            $table->integer('class_id')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->integer('company_id')->nullable();
            $table->decimal('debit', 10, 2)->default(0);
            $table->decimal('credit', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->decimal('account_period_opening', 10, 2)->default(0);
            $table->integer('deleted_by')->nullable();
           $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
        DB::unprepared(file_get_contents(public_path('/account_groups.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_groups');
    }
};
