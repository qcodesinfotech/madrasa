<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no');
            $table->string('name');
            $table->string('course_id');
            $table->string('father_name');
            $table->string('father_occupation');
            $table->string('date_of_birth');
            $table->string('aadhar_no');
            $table->string('mobile_no');
            $table->string('whatsapp_no');
            $table->string('address');
            $table->string('proof1');
            $table->string('proof2');
            $table->string('proof3');
            $table->string('proof4');
            $table->string('proof5');
            $table->string('proof6');
            $table->string('monthly_donation');
            $table->string('student_pic');
            $table->string('Admission_date');
            $table->string('blood_group');
            $table->string('previous_school');
            $table->timestamps();
        });
    }


    public function down()
    {
     Schema::dropIfExists('students');
    }
    
}
