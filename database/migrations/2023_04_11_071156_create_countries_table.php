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
        // Schema::create('countries', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->integer('status');
        //     $table->integer('other_city_id');
        //     $table->timestamps();
        // });

        DB::unprepared(file_get_contents(public_path('/countries.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
