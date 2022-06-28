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
            $table->string('full_name');      
            $table->string('profile_image')->default(0);  
            $table->string('father');
            $table->string('class_id');
            $table->string('section_id');
            $table->string('deleted_id')->default(0);
            $table->string('medium_id');
            $table->string('school_id');
            $table->string('board_id');
            $table->string('phone');
            $table->string('date_of_birth');
            $table->string('address');
            $table->string('academic_year');
            $table->string('device_id')->default(0);
            $table->string('device_type')->default(0);
            $table->string('device_token')->default(0);
       
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
