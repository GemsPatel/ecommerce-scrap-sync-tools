<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceBrightpearlOrderAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_brightpearl_order_addresses', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->string('customer_id',30);
		$table->string('customer_unique_id',30)->nullable()->default(null);
		$table->string('first_name',150)->nullable()->default(null);
		$table->string('last_name',150)->nullable()->default(null);
		$table->string('company',150)->nullable()->default(null);
		$table->string('street_1',150)->nullable()->default(null);
		$table->string('street_2',150)->nullable()->default(null);
		$table->string('city',150)->nullable()->default(null);
		$table->string('state',150)->nullable()->default(null);
		$table->string('zip',20)->nullable()->default(null);
		$table->string('country',100)->nullable()->default(null);
		$table->string('country_iso2',100)->nullable()->default(null);
		$table->string('phone',100)->nullable()->default(null);
		$table->string('address_type',100)->nullable()->default(null);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();
		$table->bigInteger('orderId')->nullable()->default(null);
		$table->bigInteger('actual_orderId')->nullable()->default(null);
		$table->bigInteger('organization_id')->nullable()->default(null);
		$table->string('email',150)->nullable()->default(null);
		$table->integer('update_status')->default('0');

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_brightpearl_order_addresses');
    }
}