<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('date')->default();
            $table->string('remark')->default('0');
            $table->string('status_1')->default('0');
            $table->string('status_2')->default('0');
            $table->string('status_3')->default('0');
            $table->string('session_1')->default('0');
            $table->string('session_2')->default('0');
            $table->string('session_3')->default('0');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
