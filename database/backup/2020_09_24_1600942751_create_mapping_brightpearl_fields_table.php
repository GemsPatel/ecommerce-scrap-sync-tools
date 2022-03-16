<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingBrightpearlFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_brightpearl_fields', function (Blueprint $table) {

		$table->increments('maf_id');
		$table->enum('mapping_for',['customer','order','product','']);
		$table->string('maf_name',100);
		$table->string('maf_parameter_name',100)->nullable()->default(null);
		$table->enum('status',['1','0',''])->default('1');

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_brightpearl_fields');
    }
}