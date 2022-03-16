<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressTable extends Migration
{
    public function up()
    {
        Schema::create('customer_address', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->bigInteger('customer_id')->index('customer_id');
		$table->string('first_name',100);
		$table->string('last_name',100);
		$table->string('company',100)->nullable()->default(null);
		$table->string('street_1',100)->nullable()->default(null);
		$table->string('street_2',100)->nullable()->default(null);
		$table->string('city',100)->nullable()->default(null);
		$table->string('state',100)->nullable()->default(null);
		$table->string('zip',20)->nullable()->default(null);
		$table->string('country',100)->nullable()->default(null);
		$table->string('country_iso2',100)->nullable()->default(null);
		$table->string('phone',100)->nullable()->default(null);
		$table->string('address_type',100)->nullable()->default(null);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_address');
    }
}