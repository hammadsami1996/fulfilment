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
//            $table->string('guard');
//            $table->integer('icon')->nullable();
//            $table->integer('sort')->nullable();
//            $table->integer('deleted_by')->nullable();
//           $table->timestamp('deleted_at')->nullable();
//
//            $table->timestamps();
//        });
         DB::unprepared(file_get_contents(public_path('/menus.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
