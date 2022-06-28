<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyllabusTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syllabus_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');        
            $table->string('year');        
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('syllabus_types');
    }


    
}
