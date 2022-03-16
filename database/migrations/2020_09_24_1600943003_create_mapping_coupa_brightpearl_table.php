<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingCoupaBrightpearlTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_coupa_brightpearl', function (Blueprint $table) {

		$table->increments('id');
		$table->enum('mapping_for',['customer','order','product','']);
		$table->integer('fk_coupa_id');
		$table->integer('fk_brightpearl_id');
		$table->enum('status',['1','0',''])->default('1');
		$table->integer('organization_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_coupa_brightpearl');
    }
}