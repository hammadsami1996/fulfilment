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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key' ,  20);
            $table->json('value')->nullable();
            $table->integer('company_id')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->integer('deleted_by')->nullable();
           $table->timestamp('deleted_at')->nullable();


            $table->timestamps();
        });

       
    //     DB::table('company_settings')->insert(['key' => 'sms_settings',
       
    
    // ]);

    // DB::table('company_settings')->insert(['key' => 'email_settings',
       

       
    // ]);

 
        
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
