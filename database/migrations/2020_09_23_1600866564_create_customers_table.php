<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id')->index('organization_id');
		$table->string('customer_id',100);
		$table->integer('threepl_cust_id')->default('0');
		$table->string('ariba_division',100)->nullable()->default(null);
		$table->string('dsco_unique_id',500)->nullable()->default(null);
		$table->string('company',100)->nullable()->default(null);
		$table->string('first_name',50)->nullable()->default(null);
		$table->string('last_name',50)->nullable()->default(null);
		$table->string('email',50)->nullable()->default(null);
		$table->string('phone',25)->nullable()->default(null);
		$table->string('form_fields',50)->nullable()->default(null);
		$table->datetime('date_created')->nullable()->default(null);
		$table->datetime('date_modified')->nullable()->default(null);
		$table->string('store_credit',50)->nullable()->default(null);
		$table->string('registration_ip_address',60)->nullable()->default(null);
		$table->integer('customer_group_id')->nullable()->default(null);
		$table->string('notes',100)->nullable()->default(null);
		$table->string('tax_exempt_category',100)->nullable()->default(null);
		$table->string('reset_pass_on_login',100)->nullable()->default(null);
		$table->integer('accepts_marketing')->nullable()->default(null);
		$table->string('addresses_url',100)->nullable()->default(null);
		$table->string('addresses_resource',100)->nullable()->default(null);
		$table->enum('status',['1','0'])->default('1');
		$table->enum('created_via',['bigcommerce','ariba','3PL','coupa','shopify','dsco'])->default('bigcommerce');
		$table->integer('map_status')->default('0');
		$table->string('map_id',50)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}