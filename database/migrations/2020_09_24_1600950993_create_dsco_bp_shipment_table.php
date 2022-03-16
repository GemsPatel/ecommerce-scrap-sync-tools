<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDscoBpShipmentTable extends Migration
{
    public function up()
    {
        Schema::create('dsco_bp_shipment', function (Blueprint $table) {

		$table->increments('id');
		$table->bigInteger('sales_order')->index('sales_order');
		$table->bigInteger('contactId');
		$table->string('order_id',100)->index('order_id');
		$table->date('date_created');
		$table->datetime('shipper_date');
		$table->string('ship_date',55)->nullable()->default(null);
		$table->integer('warehouseId');
		$table->integer('shippingMethodId');
		$table->double('total_amount', 10, 5);
		$table->string('tracking_number',200)->nullable()->default(null);
		$table->string('status',50)->default('Pending');
		$table->text('reason')->nullable()->default(null);
		$table->integer('active')->default('1');
		$table->integer('organization_id')->index('organization_id');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('dsco_bp_shipment');
    }
}