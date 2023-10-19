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
            $table->string('prefix');
            $table->string('value');
            $table->integer('deleted_by')->nullable();
           $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        // Insert a new record into the table
        DB::table('counters')->insert(['key' => 'purchase_order',
            'prefix' => 'PO-', 'value' => 100734,
            // 'prefix' => 'RO-', 'value' => 100100

            // [
            //     'key' => 'purchase_order',
            //     'prefix' => 'PO-',
            //     'value' => 100734,
            // ],
            // [
            //     'key' => 'receivable_order',
            //     'prefix' => 'RO-',
            //     'value' => 100100,
            // ],
        ]);
        DB::table('counters')->insert(['key' => 'receivable_order',

        'prefix' => 'RO-', 'value' => 100100


    ]);

    DB::table('counters')->insert(['key' => 'sales_order',

        'prefix' => 'SO-', 'value' => 100001


    ]);

    DB::table('counters')->insert(['key' => 'accounts',

    'prefix' => 'AC-', 'value' => 1001


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
