<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingBrightpearl3plTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_brightpearl_3pl', function (Blueprint $table) {

		$table->increments('id');
		$table->enum('mapping_for',['customer','order','product',''])->default('order');
		$table->string('fk_brightpearlf_id',300)->default('0');
		$table->bigInteger('fk_3plf_id')->default('0');
		$table->enum('status',['1','0',''])->default('1');
		$table->bigInteger('organization_id')->default('0');

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_brightpearl_3pl');
    }
}