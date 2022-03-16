<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('settlement_order_items', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('fk_settlement_order_id');
		$table->string('item_id',111);
		$table->string('sku',111)->nullable()->default(null);
		$table->integer('quantity')->default('0');
		$table->double('amount', 10, 5)->default('0');

        });
    }

    public function down()
    {
        Schema::dropIfExists('settlement_order_items');
    }
}