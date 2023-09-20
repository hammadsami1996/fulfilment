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
        Schema::create('account_group_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->nullable();
            $table->string('classname');
            $table->integer('class_type_id')->nullable();
            $table->integer('active');
            $table->integer('debit')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('account_period_opening')->nullable();
            $table->timestamps();
        });
        // DB::unprepared(file_get_contents(public_path('/account_group_classes.sql')));

        DB::table('account_group_classes')->insert(
            [
                'code' => 101,
                'classname' => 'Current Asset', 
                'class_type_id' => 1, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => 102,
                'classname' => 'Fixed Asset', 
                'class_type_id' => 1, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => 201,
                'classname' => 'Current Liabilities', 
                'class_type_id' => 2, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => 202,
                'classname' => 'Long Term Liabilties', 
                'class_type_id' => 2, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => 401,
                'classname' => 'Income', 
                'class_type_id' => 4, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => 501,
                'classname' => 'Expenses', 
                'class_type_id' => 5, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => 301,
                'classname' => 'Equity', 
                'class_type_id' => 3, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => null,
                'classname' => 'Cost of Goods Sold', 
                'class_type_id' => 5, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => null,
                'classname' => 'dRAWING', 
                'class_type_id' => 3, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => 302,
                'classname' => 'DRAWING', 
                'class_type_id' => 3, 
                'active' => 1
            ]
        );
        DB::table('account_group_classes')->insert(
            [
                'code' => 103,
                'classname' => 'Long Term Assets', 
                'class_type_id' => 1, 
                'active' => 1
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_group_classes');
    }
};
