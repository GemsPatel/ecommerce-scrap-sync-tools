<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountBigcommerceCredentialsTable extends Migration
{
    public function up()
    {
        Schema::create('account_bigcommerce_credentials', function (Blueprint $table) {

		$table->increments('id');
		$table->string('app_id',20)->nullable()->default(null);
		$table->string('store_id',100)->nullable()->default(null);
		$table->text('client_id')->nullable()->default(null);
		$table->text('client_secret')->nullable()->default(null);
		$table->integer('created_by')->nullable()->default(null);
		$table->integer('modified_by')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_bigcommerce_credentials');
    }
}