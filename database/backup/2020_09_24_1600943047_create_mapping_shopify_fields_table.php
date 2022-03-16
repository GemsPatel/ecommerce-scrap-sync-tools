<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingShopifyFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_shopify_fields', function (Blueprint $table) {

		$table->increments('msf_id');
		$table->string('mapping_for',50);
		$table->string('msf_name',200);
		$table->string('msf_parameter',200);
		$table->integer('is_variants')->default('0');
		$table->integer('status')->default('1');

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_shopify_fields');
    }
}