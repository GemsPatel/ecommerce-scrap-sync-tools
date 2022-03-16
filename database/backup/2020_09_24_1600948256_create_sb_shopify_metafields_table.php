<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbShopifyMetafieldsTable extends Migration
{
    public function up()
    {
        Schema::create('sb_shopify_metafields', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->bigInteger('metafields_id');
		$table->string('metafields_key',333)->nullable()->default(null);
		$table->string('bp_mapped',333)->nullable()->default(null);
		$table->string('active',55)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_shopify_metafields');
    }
}