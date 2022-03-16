<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAribaInvoiceDefaultFromAddressTable extends Migration
{
    public function up()
    {
        Schema::create('ariba_invoice_default_from_address', function (Blueprint $table) {

		$table->increments('id');
		$table->string('name',200);
		$table->string('street_1')->nullable()->default(null);
		$table->string('street_2')->nullable()->default(null);
		$table->string('city',100);
		$table->string('state',100);
		$table->string('zip',50);
		$table->string('country',100)->nullable()->default(null);
		$table->integer('organization_id');
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('ariba_invoice_default_from_address');
    }
}