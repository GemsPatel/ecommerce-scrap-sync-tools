<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('fk_order_id')->index('fk_order_id');
		$table->integer('fk_items_source_id')->index('fk_items_source_id');
		$table->integer('fk_items_brightpearl_id')->default('0')->index('fk_items_brightpearl_id');
		$table->integer('quantity');
		$table->integer('lineNumber')->default('1');
		$table->double('total_price', 10, 5);
		$table->string('dsco_item_personalization',111)->nullable()->default(null);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}