<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_customers', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->string('customer_id',30)->nullable()->default(null);
		$table->string('customer_unique_id',30)->nullable()->default(null);
		$table->string('first_name',200)->nullable()->default(null);
		$table->string('last_name',200)->nullable()->default(null);
		$table->string('company',300)->nullable()->default(null);
		$table->string('email',300)->nullable()->default(null);
		$table->string('customer_group_id',30)->nullable()->default(null);
		$table->string('phone',100)->nullable()->default(null);
		$table->string('registration_ip_address',100)->nullable()->default(null);
		$table->string('tax_exempt_category',100)->nullable()->default(null);
		$table->string('notes',200)->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();
		$table->bigInteger('organization_id')->nullable()->default(null);
		$table->tinyInteger('guest_customer')->default('0');

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_customers');
    }
}