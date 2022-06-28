<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('subject_id');
            $table->string('total');
            $table->string('correct');
            $table->string('wrong');
            $table->string('class_id');
            $table->string('school_id');
            $table->string('student_id');
            $table->string('marks');
            
            $table->string('time_left');
            $table->string('lesson_id');
            $table->string('medium_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('results');
    }
}
