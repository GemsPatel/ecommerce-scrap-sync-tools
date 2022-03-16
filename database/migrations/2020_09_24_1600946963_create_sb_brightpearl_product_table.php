<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbBrightpearlProductTable extends Migration
{
    public function up()
    {
        Schema::create('sb_brightpearl_product', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->integer('product_id');
		$table->string('productName',222)->nullable()->default(null);
		$table->integer('productTypeId');
		$table->string('sku',66)->nullable()->default(null);
		$table->string('barcode',66)->nullable()->default(null);
		$table->text('description')->nullable()->default(null);
		$table->string('act_status',55)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_brightpearl_product');
    }
}