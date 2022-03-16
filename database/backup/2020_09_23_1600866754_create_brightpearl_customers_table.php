<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrightpearlCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('brightpearl_customers', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('contactId');
		$table->string('firstName',50)->nullable()->default(null);
		$table->string('lastName',100)->nullable()->default(null);
		$table->string('email',50)->nullable()->default(null);
		$table->string('phone',20)->nullable()->default(null);
		$table->string('organisationId',50)->nullable()->default(null);
		$table->string('organisationName',100)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->date('map_date')->nullable()->default(null);
		$table->integer('organization_id')->nullable()->default(null);
		$table->integer('bigcom_fk_customer_map_id')->nullable()->default(null)->index('bigcom_fk_customer_map_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('brightpearl_customers');
    }
}