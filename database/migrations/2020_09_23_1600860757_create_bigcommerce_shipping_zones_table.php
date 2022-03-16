<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceShippingZonesTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_shipping_zones', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->integer('zoneId')->nullable()->default(null);
		$table->string('name',100)->nullable()->default(null);
		$table->string('type',100)->nullable()->default(null);
		$table->string('localtion_id',100)->nullable()->default(null);
		$table->string('location_country_iso2',100)->nullable()->default(null);
		$table->tinyInteger('free_shipping_enabled')->nullable()->default(null);
		$table->decimal('free_shipping_minimum_sub_total',10,2)->default('0.00');
		$table->tinyInteger('free_shipping_exclude_fixed_shipping_products')->nullable()->default(null);
		$table->tinyInteger('handling_fees_display_separately')->nullable()->default(null);
		$table->decimal('handling_fees_fixed_surcharge',10,2)->default('0.00');
		$table->tinyInteger('enabled')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();
		$table->bigInteger('organization_id')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_shipping_zones');
    }
}