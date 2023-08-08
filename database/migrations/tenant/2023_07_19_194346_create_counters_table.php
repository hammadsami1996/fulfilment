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
            'perfix' => 'PO-', 'value' => 100734,
            // 'perfix' => 'RO-', 'value' => 100100

            // [
            //     'key' => 'purchase_order',
            //     'perfix' => 'PO-',
            //     'value' => 100734,
            // ],
            // [
            //     'key' => 'receivable_order',
            //     'perfix' => 'RO-',
            //     'value' => 100100,
            // ],
        ]);
        DB::table('counters')->insert(['key' => 'receivable_order',
       
        'perfix' => 'RO-', 'value' => 100100

       
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
