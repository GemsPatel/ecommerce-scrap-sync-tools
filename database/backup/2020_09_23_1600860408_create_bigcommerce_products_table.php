<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceProductsTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_products', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->string('name',300)->nullable()->default(null);
		$table->string('type',50)->nullable()->default(null);
		$table->string('sku',100)->nullable()->default(null);
		$table->text('description')->nullable()->default(null);
		$table->decimal('price',5,0)->nullable()->default(null);
		$table->decimal('cost_price',5,0)->nullable()->default(null);
		$table->decimal('retail_price',5,0)->nullable()->default(null);
		$table->decimal('sale_price',5,0)->nullable()->default(null);
		$table->decimal('map_price',5,0)->nullable()->default(null);
		$table->string('product_tax_code',30)->nullable()->default(null);
		$table->integer('brand_id')->nullable()->default(null);
		$table->integer('total_sold')->nullable()->default(null);
		$table->string('upc',100)->nullable()->default(null);
		$table->string('mpn',100)->nullable()->default(null);
		$table->string('gtin',100)->nullable()->default(null);
		$table->string('product_id',30)->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();
		$table->bigInteger('organization_id')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_products');
    }
}