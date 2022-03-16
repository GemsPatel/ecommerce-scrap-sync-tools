<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateMasterTable extends Migration
{
    public function up()
    {
        Schema::create('state_master', function (Blueprint $table) {

		$table->increments('id');
		$table->string('state_name',100);
		$table->enum('status',['1','0','',])->default('1');

        });
    }

    public function down()
    {
        Schema::dropIfExists('state_master');
    }
}