<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbShopifyProductTable extends Migration
{
    public function up()
    {
        Schema::create('sb_shopify_product', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->bigInteger('product_id');
		$table->bigInteger('variants_id');
		$table->integer('variants_position');
		$table->string('title',222)->nullable()->default(null);
		$table->text('body_html')->nullable()->default(null);
		$table->string('vendor',99)->nullable()->default(null);
		$table->string('product_type',55)->nullable()->default(null);
		$table->string('product_created_at',99);
		$table->string('product_updated_at',99);
		$table->text('tags')->nullable()->default(null);
		$table->string('variants_title',222)->nullable()->default(null);
		$table->double('price', 10, 5);
		$table->double('sale_price', 10, 5)->nullable()->default(null);
		$table->string('tracked',22)->nullable()->default(null);
		$table->string('sku',88)->nullable()->default(null);
		$table->integer('taxable');
		$table->string('barcode',222)->nullable()->default(null);
		$table->string('grams',55)->nullable()->default(null);
		$table->string('weight',55)->nullable()->default(null);
		$table->string('weight_unit',55)->nullable()->default(null);
		$table->integer('inventory_quantity');
		$table->enum('sync_status',['Pending','Synced','Failed',''])->default('Pending');
		$table->string('sync_reason',222)->default('');
		$table->datetime('inserted_at')->nullable()->default(null);
		$table->datetime('sync_at')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_shopify_product');
    }
}