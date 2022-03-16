<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapping3plFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_3pl_fields', function (Blueprint $table) {

		$table->increments('mpf_id');
		$table->enum('mapping_for',['customer','order','product','']);
		$table->string('mpf_name',100);
		$table->string('mpf_parameter_name',100)->nullable()->default(null);
		$table->enum('status',['1','0',''])->default('1');

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_3pl_fields');
    }
}