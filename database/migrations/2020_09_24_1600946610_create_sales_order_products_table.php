<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderProductsTable extends Migration
{
    public function up()
    {
        Schema::create('sales_order_products', function (Blueprint $table) {

		$table->increments('id');
		$table->bigInteger('fk_sales_order_id');
		$table->string('product_id',50);
		$table->integer('quantity');
		$table->double('total_price', 10, 5);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();
		$table->integer('organization_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_order_products');
    }
}