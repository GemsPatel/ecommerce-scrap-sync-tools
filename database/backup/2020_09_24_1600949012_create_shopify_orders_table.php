<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopifyOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('shopify_orders', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->bigInteger('shopify_order_id');
		$table->string('order_number',70);
		$table->double('total_price', 10, 5);
		$table->string('shopify_created_at',100);
		$table->datetime('created_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('shopify_orders');
    }
}