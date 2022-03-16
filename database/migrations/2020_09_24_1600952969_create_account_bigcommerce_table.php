<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountBigcommerceTable extends Migration
{
    public function up()
    {
        Schema::create('account_bigcommerce', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('domain',200)->nullable()->default(null);
		$table->text('access_token')->nullable()->default(null);
		$table->integer('created_by')->nullable()->default(null);
		$table->integer('updated_by')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();
		$table->text('client_id')->nullable()->default(null);
		$table->text('client_secret')->nullable()->default(null);
		$table->text('store_id')->nullable()->default(null);
		$table->tinyInteger('customer_wh')->default('0');
		$table->tinyInteger('order_wh')->default('0');
		$table->tinyInteger('item_wh')->default('0');
		$table->tinyInteger('connection_status')->default('0');
		$table->text('bigcom_order_status')->nullable()->default(null);
		$table->tinyInteger('bigcom_guest_customer_order_sync')->default('0');
		$table->string('bigcom_guest_customer_order_address_type',20)->nullable()->default(null);
		$table->string('bigcom_item_map',20)->nullable()->default(null);
		$table->string('bp_item_map',20)->nullable()->default(null);
		$table->string('bigcom_customer_map',20)->nullable()->default(null);
		$table->string('bp_customer_map',20)->nullable()->default(null);
		$table->enum('bigcom_create_customer',['Yes','No'])->default('No');
		$table->tinyInteger('status')->default('0');
		$table->string('brightpearl_order_status',100)->nullable()->default(null);
		$table->integer('brightpearl_warehouse_id')->nullable()->default(null);
		$table->enum('bp_bundle_item',['Yes','No'])->default('No');
		$table->string('bp_shipment_status',100)->nullable()->default(null);
		$table->string('shipment_bp_order_status',20)->nullable()->default(null);
		$table->string('bp_tracking_field',50)->nullable()->default(null);
		$table->string('default_bigcommerce_shipping_method',100)->nullable()->default(null);
		$table->string('default_brightpearl_shipping_method',100)->nullable()->default(null);
		$table->integer('default_brightpearl_channel')->nullable()->default(null);
		$table->integer('default_brightpearl_project')->nullable()->default(null);
		$table->integer('default_brightpearl_lead_source')->nullable()->default(null);
		$table->string('bigcommerce_customer_staff',10)->default('No');
		$table->string('bigcommerce_customer',100)->nullable()->default(null);
		$table->string('bigcommerce_staff',100)->nullable()->default(null);
		$table->string('default_brightpearl_order_status',20)->nullable()->default(null);
		$table->string('default_bigcommerce_order_status',20)->nullable()->default(null);
		$table->string('default_brightpearl_shipping_product',30)->nullable()->default(null);
		$table->string('default_brightpearl_nominalcode',30)->nullable()->default(null);
		$table->string('default_brightpearl_taxcode',30)->nullable()->default(null);
		$table->tinyInteger('shipping_wh')->default('0');
		$table->tinyInteger('store_one_time')->default('0');

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_bigcommerce');
    }
}