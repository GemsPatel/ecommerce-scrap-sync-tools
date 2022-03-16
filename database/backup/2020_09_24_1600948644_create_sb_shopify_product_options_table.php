<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbShopifyProductOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('sb_shopify_product_options', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->bigInteger('product_id');
		$table->bigInteger('variants_id')->default('0');
		$table->string('name',111);
		$table->string('value',111);

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_shopify_product_options');
    }
}