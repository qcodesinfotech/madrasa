<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreEndsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('pre_ends', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->nullable();
            $table->string('teacher_id')->nullable();
            $table->string('date')->nullable();
            $table->string('target')->nullable();
            $table->string('course_id')->nullable();

            $table->string('remark')->nullable();
            $table->string('status')->default(0)->nullable();
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
        Schema::dropIfExists('pre_ends');
    }
}
