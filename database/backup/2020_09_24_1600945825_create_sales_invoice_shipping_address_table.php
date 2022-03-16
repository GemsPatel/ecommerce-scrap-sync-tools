<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceShippingAddressTable extends Migration
{
    public function up()
    {
        Schema::create('sales_invoice_shipping_address', function (Blueprint $table) {

		$table->increments('id');
		$table->string('Invoice_no',50)->index('Invoice_no');
		$table->string('name',200);
		$table->string('company',100)->nullable()->default(null);
		$table->string('street_1')->nullable()->default(null);
		$table->string('street_2')->nullable()->default(null);
		$table->string('city',100);
		$table->string('state',100);
		$table->string('zip',50);
		$table->string('country',100);
		$table->string('phone',50)->nullable()->default(null);
		$table->string('email',70)->nullable()->default(null);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();
		$table->integer('organization_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_invoice_shipping_address');
    }
}