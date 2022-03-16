<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonInboundShipmentsItemsTable extends Migration
{
    public function up()
    {
        Schema::create('amazon_inbound_shipments_items', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('fk_amazon_inbound_shipments');
		$table->string('SellerSKU',111)->nullable()->default(null);
		$table->integer('QuantityShipped');
		$table->integer('QuantityReceived');
		$table->integer('QuantityInCase');
		$table->string('bp_warehouse_transfer_item_reason',222)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('amazon_inbound_shipments_items');
    }
}