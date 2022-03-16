<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDscoBpShipmentBillingAddressTable extends Migration
{
    public function up()
    {
        Schema::create('dsco_bp_shipment_billing_address', function (Blueprint $table) {

		$table->increments('id');
		$table->bigInteger('sales_order_id')->index('sales_order_id');
		$table->string('name',200);
		$table->string('company',100)->nullable()->default(null);
		$table->string('street_1')->nullable()->default(null);
		$table->string('street_2')->nullable()->default(null);
		$table->string('city',100);
		$table->string('state',100);
		$table->string('zip',50);
		$table->string('country',100)->nullable()->default(null);
		$table->string('phone',50)->nullable()->default(null);
		$table->string('email',70)->nullable()->default(null);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();
		$table->integer('organization_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('dsco_bp_shipment_billing_address');
    }
}