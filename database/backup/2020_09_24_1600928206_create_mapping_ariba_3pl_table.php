<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingAriba3plTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_ariba_3pl', function (Blueprint $table) {

		$table->increments('id');
		$table->enum('mapping_for',['customer','order','product','']);
		$table->integer('fk_aribaf_id');
		$table->integer('fk_3plf_id');
		$table->enum('status',['1','0',''])->default('1');

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_ariba_3pl');
    }
}