<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {

		$table->increments('id');
		$table->string('COUNTRYID',2)->index('COUNTRYID');
		$table->string('STATEID',2)->index('STATEID');
		$table->string('FULLNAME',30);

        });
    }

    public function down()
    {
        Schema::dropIfExists('states');
    }
}