<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
 
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('valid');
            $table->string('school_id');
            $table->string('board_id');
            $table->string('is_delete')->default(0);
            $table->timestamps();
        });
    }





    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
