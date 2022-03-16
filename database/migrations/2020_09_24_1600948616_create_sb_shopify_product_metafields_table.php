<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbShopifyProductMetafieldsTable extends Migration
{
    public function up()
    {
        Schema::create('sb_shopify_product_metafields', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->bigInteger('product_id');
		$table->string('mf_key',111);
		$table->text('mf_value');

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_shopify_product_metafields');
    }
}