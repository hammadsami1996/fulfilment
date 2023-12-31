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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('customer_category',25)->nullable();
            $table->integer('deleted_by')->nullable();
           $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
        DB::table('categories')->insert(
            [
                'customer_category' => 'General  Category',
              
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
