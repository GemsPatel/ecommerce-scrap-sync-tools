<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrightpearlOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('brightpearl_orders', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->integer('sales_order_id');
		$table->string('reference',50);
		$table->string('placedOn',100);
		$table->double('total_amount', 10, 5);
		$table->integer('contactId');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('brightpearl_orders');
    }
}