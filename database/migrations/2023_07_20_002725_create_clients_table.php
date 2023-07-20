<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientstable extends Migration{
    
    public function up(){

        Schema :: create('clients', function(Blueprint $table){
            $table->id();
            $table->string('first_name');
            $table->string('middle_name') -> nullable();
            $table->string('last_name');
            $table->string('email') -> unique();
            $table->string('phone');
            $table->string('company')-> nullable();
            $table->string('website') -> nullable();
            $table->string('password');
            $table->string('city');
            $table->string('country');
            $table->string('avatar')-> nullable();
            $table->timestamps();
        });
    }

    public function down(){
        Schema :: dropIfExists('clients');
    }
};
