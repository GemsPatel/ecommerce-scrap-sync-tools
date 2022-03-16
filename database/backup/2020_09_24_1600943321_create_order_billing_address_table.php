<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderBillingAddressTable extends Migration
{
    public function up()
    {
        Schema::create('order_billing_address', function (Blueprint $table) {

		$table->increments('id');
		$table->string('order_id',50);
		$table->string('Name',100);
		$table->string('deliver_to',55)->nullable()->default(null);
		$table->string('street_1');
		$table->string('street_2');
		$table->string('city',100);
		$table->string('state',100)->nullable()->default(null);
		$table->string('zip',50);
		$table->string('country',100);
		$table->string('country_iso2',50);
		$table->string('phone',50)->nullable()->default(null);
		$table->string('email',70)->nullable()->default(null);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();
		$table->integer('organization_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_billing_address');
    }
}