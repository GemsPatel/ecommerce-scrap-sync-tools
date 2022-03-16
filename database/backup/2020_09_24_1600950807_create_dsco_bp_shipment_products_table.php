<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDscoBpShipmentProductsTable extends Migration
{
    public function up()
    {
        Schema::create('dsco_bp_shipment_products', function (Blueprint $table) {

		$table->increments('id');
		$table->bigInteger('sales_order_id');
		$table->string('product_id',50);
		$table->integer('quantity');
		$table->double('total_price', 10, 5);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();
		$table->integer('organization_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('dsco_bp_shipment_products');
    }
}