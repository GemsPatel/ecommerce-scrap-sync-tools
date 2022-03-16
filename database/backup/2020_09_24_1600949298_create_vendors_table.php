<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('intacct_recorded_id');
		$table->string('vendor_id',100);
		$table->string('Name',100)->nullable()->default(null);
		$table->string('Status',25)->nullable()->default(null);
		$table->string('First_name',100)->nullable()->default(null);
		$table->string('Middle_name',100)->nullable()->default(null);
		$table->string('Last_name',100)->nullable()->default(null);
		$table->string('Primary_phone',100)->nullable()->default(null);
		$table->string('Mobile',100)->nullable()->default(null);
		$table->string('Pager',100)->nullable()->default(null);
		$table->string('Print_as',100)->nullable()->default(null);
		$table->string('Fax',100)->nullable()->default(null);
		$table->string('Address_1',100)->nullable()->default(null);
		$table->string('Address_2',100)->nullable()->default(null);
		$table->string('City',100)->nullable()->default(null);
		$table->string('State',100)->nullable()->default(null);
		$table->string('Zip_code',100)->nullable()->default(null);
		$table->string('Country',100)->nullable()->default(null);
		$table->string('Email_address',100)->nullable()->default(null);
		$table->string('Secondary_email_address',100)->nullable()->default(null);
		$table->string('URL',100)->nullable()->default(null);
		$table->datetime('date_created')->nullable()->default(null);
		$table->datetime('date_modified');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}