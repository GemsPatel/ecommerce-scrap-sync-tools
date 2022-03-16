<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsBrightpearlTable extends Migration
{
    public function up()
    {
        Schema::create('brightpearl_product', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->integer('item_id');
		$table->string('sku',100)->nullable()->default(null);
		$table->string('name');
		$table->string('upc',100)->nullable()->default(null);
		$table->string('isbn',100)->nullable()->default(null);
		$table->string('ean',100)->nullable()->default(null);
		$table->string('mpn',100)->nullable()->default(null);
		$table->string('barcode',100)->nullable()->default(null);
		$table->string('status',50)->nullable()->default(null);
		$table->enum('mapped_with_all',['Yes','No'])->default('No');
		$table->integer('created_by');
		$table->integer('updated_by');
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();
		$table->integer('bigcom_fk_item_map_id')->nullable()->default(null)->index('bigcom_fk_item_map_id');
		$table->string('phone',20)->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('brightpearl_product');
    }
}