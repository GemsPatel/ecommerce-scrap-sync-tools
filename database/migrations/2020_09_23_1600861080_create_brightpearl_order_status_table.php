<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrightpearlOrderStatusTable extends Migration
{
    public function up()
    {
        Schema::create('brightpearl_order_status', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('statusId');
		$table->string('name',200)->nullable()->default(null);
		$table->string('orderTypeCode',10);
		$table->tinyInteger('disabled');
		$table->tinyInteger('visible');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();
		$table->bigInteger('organization_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('brightpearl_order_status');
    }
}