<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderResponseTable extends Migration
{
    public function up()
    {
        Schema::create('order_response', function (Blueprint $table) {

		$table->increments('id');
		$table->string('order_id',100)->nullable()->default(null);
		$table->text('response')->nullable()->default(null);
		$table->datetime('datetime')->nullable()->useCurrent();
		$table->bigInteger('organization_id')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_response');
    }
}