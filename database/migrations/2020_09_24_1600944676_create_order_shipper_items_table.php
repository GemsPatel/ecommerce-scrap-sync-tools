<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShipperItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_shipper_items', function (Blueprint $table) {

		$table->increments('id');
		$table->string('shipper_no',50)->index('shipper_no');
		$table->integer('quantity');
		$table->double('total_price', 10, 5);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();
		$table->string('fk_items_brightpearl_id',100);
		$table->bigInteger('organization_id')->nullable()->default(null);
		$table->bigInteger('fk_item_source_id')->default('0');

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_shipper_items');
    }
}