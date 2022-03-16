<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingValueAribaIntaTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_value_ariba_inta', function (Blueprint $table) {

		$table->increments('id');
		$table->string('ANI_Number',50);
		$table->string('Intacct_customer',50);
		$table->enum('status',['1','0',''])->default('1');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('update_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_value_ariba_inta');
    }
}