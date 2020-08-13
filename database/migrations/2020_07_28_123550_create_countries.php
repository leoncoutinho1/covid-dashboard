<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('iso2');
            $table->string('iso3');
            $table->string('capital');
            $table->string('region');
            $table->string('subregion');
            $table->double('population');
            $table->string('nativeName');
            $table->double('area');
            $table->string('flag');
            
            
            $table->timestamps();
        });
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
