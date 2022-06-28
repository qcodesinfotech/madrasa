<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructuresTable extends Migration
{

    public function up()
    {
        Schema::create('structures', function (Blueprint $table) {
            
            $table->id();
            $table->string('para_id');
            $table->string('teacher_id');
            $table->string('student_id');
            $table->string('arabic_date');
            $table->string('course_id')->nullable();
            $table->timestamps();

        });

    }
    public function down()
    {
        Schema::dropIfExists('structures');
    }
}
