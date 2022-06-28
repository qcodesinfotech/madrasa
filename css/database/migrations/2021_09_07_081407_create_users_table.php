<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('users', function (Blueprint $table) {
        
            $table->id();
            $table->string('role_id');
            $table->string('full_name');
            $table->string('phone');
            $table->string('phone2');
            $table->string('address');
            $table->string('proof1');
            $table->string('proof2');
            $table->string('proof3');
            $table->string('proof4');
            $table->string('proof5');
            $table->string('proof6');
            $table->string('father');
            $table->string('degree');
            $table->string('password');
            $table->string('device_id')->default("0");
            $table->string('device_token')->default("0");
            $table->string('is_delete')->default("0");
            $table->timestamps();

        });

    }
    



    
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
