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
//        Schema::create('user_types', function (Blueprint $table) {
//            $table->id();
//            $table->string('user_type')->nullable();
//            $table->rememberToken();
//            $table->timestamps();
//        });
        DB::unprepared(file_get_contents(public_path('/user_type.sql')));

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_types');
    }
};
