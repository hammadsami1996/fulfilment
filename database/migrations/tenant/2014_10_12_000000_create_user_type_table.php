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
       Schema::create('user_types', function (Blueprint $table) {
           $table->id();
           $table->string('user_type')->nullable();
           $table->int('created_by')->nullable();
           $table->int('updated_by')->nullable();
           $table->rememberToken();
           $table->timestamps();
       });
        DB::unprepared(file_get_contents(public_path('/user_type.sql')));

        DB::table('user_types')->insert(
            [
                'user_type' => 'Admin',
                'created_by' => 1,
            ],
            [
                'user_type' => 'Employee',
                'created_by' => 1,
            ],
            [
                'user_type' => 'Candidate',
                'created_by' => 1,
            ],
        );

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_types');
    }
};
