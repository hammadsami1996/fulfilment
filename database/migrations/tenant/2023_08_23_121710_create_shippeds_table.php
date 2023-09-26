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
            $table->integer('company_id')->nullable();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
        });
        // DB::unprepared(file_get_contents(public_path('/shippeds.sql')));

        DB::table('shippeds')->insert(
            [
                'name' => 'Leopards Overland',
            ]
        );
        DB::table('shippeds')->insert(
            [
                'name' => 'Trax Saverplus',
            ]
        );
        DB::table('shippeds')->insert(
            [
                'name' => 'Rider Overland',
            ]
        );
        DB::table('shippeds')->insert(
            [
                'name' => 'Karachi Courier',
            ]
        );
        DB::table('shippeds')->insert(
            [
                'name' => 'Trax Rush',
            ]
        );
        DB::table('shippeds')->insert(
            [
                'name' => 'Leopards Overnight',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippeds');
    }
};
