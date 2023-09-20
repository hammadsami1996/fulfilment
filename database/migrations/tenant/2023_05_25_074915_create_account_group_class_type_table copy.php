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
        Schema::create('account_group_class_types', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->nullable();
            $table->string('class_type');
            $table->string('main_class');
            $table->integer('debit')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('active');
            $table->integer('account_period_opening')->nullable();
            $table->timestamps();
        });
        // DB::unprepared(file_get_contents(public_path('/account_group_class_types.sql')));

        DB::table('account_group_class_types')->insert(
            [
                'code' => 1,
                'class_type' => 'Assets', 
                'main_class' => 'Balance Sheet',
                'active' => 1
            ]
        );
        DB::table('account_group_class_types')->insert(
            [
                'code' => 2,
                'class_type' => 'Liabilities', 
                'main_class' => 'Balance Sheet',
                'active' => 1
            ]
        );
        DB::table('account_group_class_types')->insert(
            [
                'code' => 3,
                'class_type' => 'Capital/Equity', 
                'main_class' => 'Balance Sheet',
                'active' => 1
            ]
        );
        DB::table('account_group_class_types')->insert(
            [
                'code' => 4,
                'class_type' => 'Revenues', 
                'main_class' => 'Income Statement',
                'active' => 1
            ]
        );
        DB::table('account_group_class_types')->insert(
            [
                'code' => 5,
                'class_type' => 'Expenses & Purchase', 
                'main_class' => 'Income Statement',
                'active' => 1
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_group_class_types');
    }
};
