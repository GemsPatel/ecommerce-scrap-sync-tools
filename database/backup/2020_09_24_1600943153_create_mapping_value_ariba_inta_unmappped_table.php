<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingValueAribaIntaUnmapppedTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_value_ariba_inta_unmappped', function (Blueprint $table) {

		$table->increments('id');
		$table->string('ANI_Number',50)->index('ANI_Number');
		$table->text('webhook_response');
		$table->enum('status',['1','0',''])->default('1');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('update_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_value_ariba_inta_unmappped');
    }
}