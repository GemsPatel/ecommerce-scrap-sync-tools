<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbBrightpearlOptionValueTable extends Migration
{
    public function up()
    {
        Schema::create('sb_brightpearl_option_value', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->integer('optionId');
		$table->bigInteger('option_value_id');
		$table->string('option_value_name',333)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_brightpearl_option_value');
    }
}