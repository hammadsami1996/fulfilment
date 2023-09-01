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
//        Schema::create('menus', function (Blueprint $table) {
//            $table->id();
//            $table->string('title');
//            $table->string('url')->nullable();
//            $table->string('route')->nullable();
//            $table->integer('head_id')->nullable();
//            $table->integer('guard');
//            $table->integer('icon')->nullable();
//            $table->integer('sort')->nullable();
//            $table->timestamps();
//        });
        DB::unprepared(file_get_contents(public_path('/account_group_classes.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_group_classes');
    }
};
