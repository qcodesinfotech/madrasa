<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table){

            $table->id();
            $table->string('assign_id');
            $table->string('syllabus_id');
            $table->string('month')->nullable();
            $table->string('target1')->nullable();
            $table->string('target2')->nullable();
            $table->string('target3')->nullable();
            $table->string('target4')->nullable();
            $table->string('target5')->nullable();
            $table->string('target6')->nullable();
            $table->string('t_date1')->nullable();
            $table->string('t_date2')->nullable();
            $table->string('t_date3')->nullable();
            $table->string('t_date4')->nullable();
            $table->string('t_date5')->nullable();
            $table->string('t_date6')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('details');
    }
}
