<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingBigcommerceBrightpearlShippingMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_bigcommerce_brightpearl_shipping_methods', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->integer('bigcom_fk_shippingId')->nullable()->default(null);
		$table->integer('bp_fk_shippingId')->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();
		$table->bigInteger('organization_id')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_bigcommerce_brightpearl_shipping_methods');
    }
}