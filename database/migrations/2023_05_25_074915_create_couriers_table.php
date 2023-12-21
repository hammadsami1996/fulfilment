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
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('account_id')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
        DB::table('couriers')->insert(
            [
                'name' => 'Trax Saverplus',
                'account_id' => 2
            ]
        );
        DB::table('couriers')->insert(
            [
                'name' => 'Leopards Overland',
                'account_id' => 3
            ]
        );
        DB::table('couriers')->insert(
            [
                'name' => 'Rider Overland',
                'account_id' => 4
            ]
        );
        DB::table('couriers')->insert(
            [
                'name' => 'Karachi Courier',
                'account_id' => 5
            ]
        );
        DB::table('couriers')->insert(
            [
                'name' => 'Trax Rush',
                'account_id' => 6
            ]
        );
        DB::table('couriers')->insert(
            [
                'name' => 'Leopards Overnight',
                'account_id' => 7
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couriers');
    }
};
