<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbShopifyProductImagesTable extends Migration
{
    public function up()
    {
        Schema::create('sb_shopify_product_images', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->bigInteger('product_id');
		$table->bigInteger('variants_id')->default('0');
		$table->text('src');

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_shopify_product_images');
    }
}