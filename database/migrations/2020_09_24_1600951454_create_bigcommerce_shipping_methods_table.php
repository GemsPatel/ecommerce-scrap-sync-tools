<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceShippingMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_shipping_methods', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->integer('shippingId')->nullable()->default(null);
		$table->string('name',300)->nullable()->default(null);
		$table->string('type',200)->nullable()->default(null);
		$table->tinyInteger('enabled')->nullable()->default(null);
		$table->double('handling_fees_fixed_surcharge', 10, 5)->nullable()->default(null);
		$table->double('handling_fees_percentage_surcharge', 10, 5)->nullable()->default(null);
		$table->tinyInteger('is_fallback')->nullable()->default(null);
		$table->integer('zoneId')->nullable()->default(null);
		$table->integer('organization_id');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_shipping_methods');
    }
}