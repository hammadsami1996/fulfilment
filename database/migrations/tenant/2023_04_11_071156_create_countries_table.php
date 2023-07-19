<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    public function up()
//    {
//        Schema::create('countries', function (Blueprint $table) {
//            $table->id();
//            $table->string('name');
//            $table->string('iso3');
//            $table->string('iso2');
//            $table->string('phonecode');
//            $table->string('capital');
//            $table->string('currency');
//            $table->string('currency_symbol');
//            $table->string('tld');
//            $table->string('native')->nullable();
//            $table->string('region');
//            $table->string('subregion');
//            $table->text('timezones');
//            $table->text('translations')->nullable();
//            $table->text('latitude');
//            $table->text('longitude');
//            $table->text('emoji');
//            $table->text('emojiU');
//            $table->boolean('flag')->default(false);
//            $table->text('wikiDataId')->nullable();
//            $table->timestamps();
//        });
//    }
    public function up()
    {
        DB::unprepared(file_get_contents(public_path('/country_city.sql')));
        DB::unprepared(file_get_contents(public_path('/permissions.sql')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
