<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShipperTable extends Migration
{
    public function up()
    {
        Schema::create('order_shipper', function (Blueprint $table) {

		$table->increments('id');
		$table->string('shipper_no',100)->nullable()->default(null)->index('shipper_no');
		$table->string('sales_order_no',100);
		$table->string('order_id',100)->nullable()->default(null)->index('order_id');
		$table->string('fk_brightpearl_cust_id',50);
		$table->string('fk_brightpearl_cust_cid',50)->nullable()->default(null);
		$table->date('shipper_date')->nullable()->default(null);
		$table->date('ship_date')->nullable()->default(null);
		$table->double('total_amount', 10, 5)->nullable()->default(null);
		$table->integer('brightpearl_RECORDNO')->nullable()->default(null);
		$table->integer('shipper_3pl_sts')->default('0');
		$table->bigInteger('threepl_order_id')->nullable()->default(null);
		$table->string('track_number',100)->nullable()->default(null);
		$table->datetime('confirm_date')->nullable()->default(null);
		$table->enum('is_coupa_order',['Yes','No'])->default('No');
		$table->string('threePL_BillingCharges',4)->nullable()->default(null);
		$table->integer('threepl_retry')->default('0');
		$table->integer('is_active')->default('1');
		$table->integer('organization_id');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();
		$table->string('order_status_code',100)->nullable()->default(null);
		$table->tinyInteger('skipped_status')->default('0');
		$table->integer('created_by')->nullable()->default(null);
		$table->integer('shippingMethodId')->default('0');

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_shipper');
    }
}