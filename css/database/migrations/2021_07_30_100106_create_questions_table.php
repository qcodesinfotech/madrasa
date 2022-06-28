<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->string('option_4');
            $table->string('answer');
            $table->string('board_id');
            $table->string('subject_id');
            $table->string('lesson_id');
            $table->string('medium_id'); 
            $table->string('class_id');
            $table->string('academic_id');
            $table->string('is_delete')->default(0);
            $table->string('question_image')->default(',');
            $table->string('option_image_1')->default(',');
            $table->string('option_image_2')->default(',');
            $table->string('option_image_3')->default(',');
            $table->string('option_image_4')->default(',');
            $table->string('answer_image')->default(',');
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
        Schema::dropIfExists('questions');
    }
}
