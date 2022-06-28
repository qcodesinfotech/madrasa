<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExammanagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exammanagements', function (Blueprint $table) {
            $table->id();
            $table->string('question_id');
            $table->string('date');
            $table->string('class_id');
            $table->string('subject_id');
            $table->string('lesson_id');
            $table->string('board_id');
            $table->string('medium_id');
            $table->string('category_id');
            $table->string('academic_id');
            $table->integer('is_show')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exammanagement');
    }
}
