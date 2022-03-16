<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('settlement_orders', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('marketplace_seller',200)->nullable()->default(null);
		$table->integer('fk_ebay_account_id')->nullable()->default(null);
		$table->double('settlement_id', 10, 5);
		$table->string('transaction_type',55)->nullable()->default(null);
		$table->string('posted_date',55);
		$table->string('order_id',55)->nullable()->default(null);
		$table->enum('is_order_item_sync',['Yes','No'])->default('No');
		$table->datetime('order_item_sync_at')->nullable()->default(null);
		$table->double('total_amount', 10, 5)->nullable()->default(null);
		$table->enum('created_via',['amazon','ebay'])->default('amazon');
		$table->enum('sync_status',['Pending','Synced','Failed'])->default('Pending');
		$table->text('reason')->nullable()->default(null);
		$table->integer('sales_credit_id')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('settlement_orders');
    }
}