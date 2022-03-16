<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonInboundShipmentsInventoryItemsTable extends Migration
{
    public function up()
    {
        Schema::create('amazon_inbound_shipments_inventory_items', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('marketplace_seller',111);
		$table->string('ShipmentId',111)->nullable()->default(null);
		$table->string('SKU',111)->nullable()->default(null);
		$table->text('Product_name')->nullable()->default(null);
		$table->integer('Quantity');
		$table->datetime('received_date');
		$table->integer('ready_to_release')->default('0');
		$table->enum('bp_release_status',['Pending','Released','Failed'])->default('Pending');
		$table->string('bp_release_reason',111)->nullable()->default(null);
		$table->datetime('bp_release_date')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('amazon_inbound_shipments_inventory_items');
    }
}