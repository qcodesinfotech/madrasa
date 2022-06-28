<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyNazUpdatesTable extends Migration
{

    public function up()
    {
        Schema::create('daily_naz_updates', function (Blueprint $table){

            $table->id();
            $table->string('arabic_date')->default('');
            $table->string('day')->default('');
            $table->string('old_exam')->default('');
            $table->string('exam_1')->default('');
            $table->string('exam_1a')->default('');
            $table->string('exam_2')->default('');
            $table->string('exam_2a')->default('');
            $table->string('exam_3')->default('');
            $table->string('exam_3a')->default('');
            $table->string('total')->default('');
            $table->string('revision')->default('');
            $table->string('n_exam')->default('');
            $table->string('month')->default('');
            $table->string('total_sub_week')->default('');
            $table->string('remark')->default('');
            $table->string('nisf')->default('');
            $table->string('overall_para')->default('');
            $table->string('course_id')->default('');
            $table->string('e_parah')->default('0');
            $table->string('read_status')->default('0');
            $table->string('read_status1')->default('');
            $table->string('read_status2')->default('');
            $table->string('teacher_id')->default('');
            $table->string('student_id');
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
        Schema::dropIfExists('daily_naz_updates');
    }
}
