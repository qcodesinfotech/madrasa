<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyllabusAddsTable extends Migration
{
    public function up()
    {
        
        Schema::create('syllabus_adds', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->nullable();
            $table->string('month')->nullable();
            $table->string('course_id')->nullable();
            $table->string('no_of_parah')->nullable();
            $table->string('target')->nullable();
            $table->string('completion')->nullable();
            $table->string('c_target')->nullable();
            $table->string('remark')->nullable();
            $table->string('status')->nullable();
            $table->string('teacher_id')->nullable();
            $table->string('year')->nullable();
            $table->string('arabic_date')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('syllabus_adds');
    }
}
