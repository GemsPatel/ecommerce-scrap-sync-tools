<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonInboundShipmentsTable extends Migration
{
    public function up()
    {
        Schema::create('amazon_inbound_shipments', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('marketplace_seller',111);
		$table->string('ShipmentId',111);
		$table->string('ShipmentName',111)->nullable()->default(null);
		$table->string('ShipmentStatus',111)->nullable()->default(null);
		$table->string('ShipFromAddress_Unique',500);
		$table->datetime('added_at');
		$table->string('bp_warehouse_transfer_status',55)->default('Pending');
		$table->string('bp_warehouse_transfer_reason',222)->nullable()->default(null);
		$table->datetime('bp_warehouse_transfer_date')->nullable()->default(null);
		$table->integer('bp_warehouse_transfer_id')->nullable()->default(null);
		$table->integer('goodsOutNoteId')->nullable()->default(null);
		$table->enum('bp_good_out_shipped',['Yes','No'])->default('No');
		$table->enum('bp_good_out_canceled',['Yes','No'])->default('No');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('amazon_inbound_shipments');
    }
}