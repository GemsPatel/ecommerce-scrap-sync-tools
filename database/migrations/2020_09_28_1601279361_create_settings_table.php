<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {

		$table->increments('id');
		$table->string('order_bp_field',30)->nullable()->default(null);
		$table->tinyInteger('switch_3pl_button')->default('0');
		$table->string('create_order_in_3pl',30)->nullable()->default(null);
		$table->string('sales_order_status_3pl',30)->nullable()->default(null);
		$table->string('brighperl_product_fields',30)->nullable()->default(null);
		$table->string('item_fields_3pl',30)->nullable()->default(null);
		$table->string('brightpearl_warehouse',30)->nullable()->default(null);
		$table->string('shipment_bp_order_status',30)->nullable()->default(null);
		$table->string('shipping_method_3pl',30)->nullable()->default(null);
		$table->string('shipping_method_brightpearl_advance',30)->nullable()->default(null);
		$table->string('shipping_method_3pl_advance',30)->nullable()->default(null);
		$table->integer('ariba_brightpearl_channel')->nullable()->default(null);
		$table->integer('ariba_brightpearl_lead_source')->nullable()->default(null);
		$table->integer('ariba_brightpearl_shipping_method')->nullable()->default(null);
		$table->string('ariba_brightpearl_product_tax_code',20)->nullable()->default(null);
		$table->string('ariba_brightpearl_productMatch_arb',50)->nullable()->default(null);
		$table->string('ariba_brightpearl_productMatch_bp',50)->nullable()->default(null);
		$table->string('ariba_brightpearl_skip_items',333)->nullable()->default(null);
		$table->enum('ariba_brightpearl_handling',['Yes','No'])->default('No');
		$table->enum('ariba_brightpearl_handling_condition',['Fix','Conditional'])->default('Fix');
		$table->double('ariba_brightpearl_handling_charge', 10, 2)->default('0');
		$table->enum('ariba_brightpearl_handling_condition_set',['less','greater'])->default('less');
		$table->double('ariba_brightpearl_handling_total_amount', 10, 2)->default('0');
		$table->text('ariba_brightpearl_handling_description')->nullable()->default(null);
		$table->integer('coupa_brightpearl_channel')->nullable()->default(null);
		$table->integer('coupa_brightpearl_lead_source')->nullable()->default(null);
		$table->integer('coupa_brightpearl_shipping_method')->nullable()->default(null);
		$table->string('coupa_brightpearl_product_tax_code',20)->nullable()->default(null);
		$table->string('coupa_brightpearl_productMatch_cp',50)->nullable()->default(null);
		$table->string('coupa_brightpearl_productMatch_bp',50)->nullable()->default(null);
		$table->string('coupa_brightpearl_skip_items',333)->nullable()->default(null);
		$table->integer('create_shopify_webhook')->default('0');
		$table->string('shopify_brightpearl_frequency',50)->nullable()->default(null);
		$table->integer('shopify_brightpearl_cron_active')->default('1');
		$table->string('shopify_brightpearl_image_custom',50)->nullable()->default(null);
		$table->integer('shopify_brightpearl_warehouse')->default('0');
		$table->string('shopify_brightpearl_warehouse_grouping',30)->default('groupingA');
		$table->string('amazon_brightpearl_productMatch_amz',55)->default('SKU');
		$table->string('amazon_brightpearl_productMatch_bp',55)->default('sku');
		$table->integer('amazon_brightpearl_credit_new_status')->nullable()->default(null);
		$table->string('amazon_brightpearl_discrepancies_frequency',30)->default('1');
		$table->string('ebay_brightpearl_productMatch_eb',55)->nullable()->default(null);
		$table->string('ebay_brightpearl_productMatch_bp',55)->nullable()->default(null);
		$table->integer('ebay_brightpearl_credit_new_status')->nullable()->default(null);
		$table->integer('dsco_brightpearl_channel')->nullable()->default(null);
		$table->integer('dsco_brightpearl_lead_source')->nullable()->default(null);
		$table->integer('dsco_brightpearl_shipping_method')->nullable()->default(null);
		$table->integer('dsco_brightpearl_warehouse')->nullable()->default(null);
		$table->string('dsco_brightpearl_product_tax_code',20)->nullable()->default(null);
		$table->string('dsco_brightpearl_productMatch_ds',55)->nullable()->default(null);
		$table->string('dsco_brightpearl_productMatch_bp',55)->nullable()->default(null);
		$table->enum('dsco_brightpearl_customer_auto_bp',['No','Yes'])->default('No');
		$table->string('dsco_brightpearl_customer_from',55)->default('Shipping');
		$table->string('dsco_brightpearl_gift_message',55)->nullable()->default(null);
		$table->string('dsco_brightpearl_ship_instruction',55)->nullable()->default(null);
		$table->string('dsco_brightpearl_personalize_name',55)->nullable()->default(null);
		$table->string('dsco_brightpearl_consumer_order_id',55)->nullable()->default(null);
		$table->string('dsco_brightpearl_shipment_by_action',55)->nullable()->default(null);
		$table->string('dsco_brightpearl_shipment_by_action_sts',55)->nullable()->default(null);
		$table->string('dsco_brightpearl_shipment_tracking_field',55)->nullable()->default(null);
		$table->integer('dsco_brightpearl_order_cancellation')->nullable()->default(null);
		$table->enum('dsco_brightpearl_invoice_sync_status',['ON','OFF'])->default('ON');
		$table->string('dsco_brightpearl_skip_items',333)->nullable()->default(null);
		$table->integer('dsco_brightpearl_order_new_status')->nullable()->default(null);
		$table->enum('dsco_brightpearl_inventory_sync_status',['ON','OFF'])->default('ON');
		$table->integer('dsco_initially_inventory_stock_sync')->default('0');
		$table->integer('organization_id');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();
		$table->tinyInteger('status');
		$table->string('ignore_item_ids',300)->nullable()->default(null);
		$table->tinyInteger('convert_bundle')->default('0');
		$table->tinyInteger('create_bp_webhook')->default('0');
		$table->tinyInteger('shipping_method_advance')->default('0');
		$table->string('bigcommerce_brightpearl_productMatch_bp',10)->nullable()->default(null);
		$table->string('bigcommerce_brightpearl_productMatch_sp',10)->nullable()->default(null);
		$table->enum('bigcommerce_brightpearl_customer_with_order',['Yes','No'])->default('No');
		$table->string('bigcommerce_brightpearl_customerMatch_bp',100)->nullable()->default(null);
		$table->string('bigcommerce_brightpearl_customerMatch_sp',100)->nullable()->default(null);
		$table->enum('bigcommerce_brightpearl_customer_allow_create',['Yes','No'])->default('No');

        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}