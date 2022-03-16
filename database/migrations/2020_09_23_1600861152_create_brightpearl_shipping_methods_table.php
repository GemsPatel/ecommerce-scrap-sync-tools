<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrightpearlShippingMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('brightpearl_shipping_methods', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->integer('shippingId');
		$table->string('name',200)->nullable()->default(null);
		$table->string('code',30)->nullable()->default(null);
		$table->string('breaks',300)->nullable()->default(null);
		$table->integer('methodType')->nullable()->default(null);
		$table->tinyInteger('additionalInformationRequired')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();
		$table->bigInteger('organization_id')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('brightpearl_shipping_methods');
    }
}