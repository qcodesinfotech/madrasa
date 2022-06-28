<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBasedParasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('student_based_paras', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('para_id');
            $table->string('para_order');
            $table->timestamps();
        });
    }

    public function down()
    {
    Schema::dropIfExists('student_based_paras');
    }
}
