<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonInboundShipmentsAddressTable extends Migration
{
    public function up()
    {
        Schema::create('amazon_inbound_shipments_address', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('marketplace_seller',111);
		$table->string('ShipFromAddress_City',111)->nullable()->default(null);
		$table->string('ShipFromAddress_CountryCode',111)->nullable()->default(null);
		$table->string('ShipFromAddress_PostalCode',111)->nullable()->default(null);
		$table->string('ShipFromAddress_Name',111)->nullable()->default(null);
		$table->text('ShipFromAddress_AddressLine1')->nullable()->default(null);
		$table->string('ShipFromAddress_StateOrProvinceCode',111)->nullable()->default(null);
		$table->string('ShipFromAddress_Unique',500);
		$table->integer('bp_warehouse_map_id')->nullable()->default(null);
		$table->datetime('added_at');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('amazon_inbound_shipments_address');
    }
}