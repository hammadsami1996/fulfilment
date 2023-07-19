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
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('perfix');
            $table->string('value');
            $table->timestamps();
        });

        // Insert a new record into the table
        DB::table('counters')->insert(['key' => 'purchase_order',
            'perfix' => 'PO-', 'value' => 100734// Add more columns and values as needed.
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counters');
    }
};
