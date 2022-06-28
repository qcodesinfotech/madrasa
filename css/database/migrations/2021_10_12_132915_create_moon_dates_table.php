<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoonDatesTable extends Migration
{
 
    public function up()
    {
        Schema::create('moon_dates', function (Blueprint $table) {
            $table->id();
            $table->string('english_date')->nullable();
            $table->string('arabic_date')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('moon_dates');
    }

}
