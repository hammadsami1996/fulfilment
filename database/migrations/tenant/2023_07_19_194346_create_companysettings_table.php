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
        Schema::create('companysettings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('active')->nullable();


            $table->timestamps();
        });

       
        DB::table('companysettings')->insert(['key' => 'sms_settings',
       
       

       
    ]);

    DB::table('companysettings')->insert(['key' => 'email_settings',
       
        

       
    ]);

 
        
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companysettings');
    }
};
