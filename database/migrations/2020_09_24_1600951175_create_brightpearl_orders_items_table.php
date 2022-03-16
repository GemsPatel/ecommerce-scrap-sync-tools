<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrightpearlOrdersItemsTable extends Migration
{
    public function up()
    {
        Schema::create('brightpearl_orders_items', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('fk_brightpearl_orders_id');
		$table->integer('productId');
		$table->string('productName',111);
		$table->string('productSku',55);
		$table->integer('quantity');
		$table->double('itemCost', 10, 5);
		$table->double('total_amt', 10, 5);

        });
    }

    public function down()
    {
        Schema::dropIfExists('brightpearl_orders_items');
    }
}