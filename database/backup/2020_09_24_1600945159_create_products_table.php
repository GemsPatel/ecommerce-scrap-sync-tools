<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

		$table->increments('id');
		$table->string('product_id',50);
		$table->string('intacct_item_id',50);
		$table->string('name')->nullable()->default(null);
		$table->string('sku')->nullable()->default(null);
		$table->string('type')->nullable()->default(null);
		$table->double('base_price', 10, 5);
		$table->double('price_ex_tax', 10, 5);
		$table->double('price_inc_tax', 10, 5);
		$table->double('price_tax', 10, 5);
		$table->double('base_total', 10, 5);
		$table->double('total_ex_tax', 10, 5);
		$table->double('total_inc_tax', 10, 5);
		$table->double('weight', 10, 5);
		$table->enum('created_via',['bigcommerce','intacct','ariba',''])->default('bigcommerce');
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}