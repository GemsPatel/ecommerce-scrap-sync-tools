<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id')->index('organization_id');
		$table->integer('fk_customer_id')->index('fk_customer_id');
		$table->string('order_id',50)->index('order_id');
		$table->datetime('date_created');
		$table->date('due_date')->nullable()->default(null);
		$table->string('status',100)->nullable()->default(null);
		$table->double('subtotal_ex_tax', 10, 5)->nullable()->default(null);
		$table->double('subtotal_inc_tax', 10, 5)->nullable()->default(null);
		$table->double('total_tax', 10, 5)->nullable()->default(null);
		$table->double('total_ex_tax', 10, 5)->nullable()->default(null);
		$table->double('total_inc_tax', 10, 5)->nullable()->default(null);
		$table->double('base_shipping_cost', 10, 5)->nullable()->default(null);
		$table->double('items_total', 10, 5)->nullable()->default(null);
		$table->integer('currency_id')->nullable()->default(null);
		$table->string('currency_code',50)->default('USD');
		$table->string('payment_terms',100)->nullable()->default(null);
		$table->text('Comments')->nullable()->default(null);
		$table->text('ariba_payload_id')->nullable()->default(null);
		$table->string('dsco_account_user',55)->nullable()->default(null);
		$table->string('dsco_ship_carrier',55)->nullable()->default(null);
		$table->string('dsco_ship_method',55)->nullable()->default(null);
		$table->string('dsco_warehouse_code',55)->nullable()->default(null);
		$table->text('dsco_ship_instructions')->nullable()->default(null);
		$table->text('dsco_gift_message')->nullable()->default(null);
		$table->string('dsco_consumer_order_number',222)->nullable()->default(null);
		$table->string('dsco_cancel_process',55)->nullable()->default(null);
		$table->string('dsco_filename',77)->nullable()->default(null);
		$table->string('created_via',50)->default('bigcommerce');
		$table->string('sync_status',50)->default('pending');
		$table->string('sync_reason',100)->nullable()->default(null);
		$table->string('sales_order',100)->nullable()->default(null);
		$table->string('sales_invoice',100)->nullable()->default(null);
		$table->integer('int_cron_execute')->default('0');
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();
		$table->tinyInteger('retry')->default('0');
		$table->tinyInteger('threepl_retry')->default('0');
		$table->integer('sent_acknldge')->default('0');
		$table->integer('under_process')->default('1');

        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
