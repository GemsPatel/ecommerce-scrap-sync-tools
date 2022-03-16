<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountAmazonTable extends Migration
{
    public function up()
    {
        Schema::create('account_amazon', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('customer_name',100);
		$table->text('marketplace_id');
		$table->text('seller_id');
		$table->string('marketplace_seller',200)->nullable()->default(null);
		$table->text('mws_auth_token');
		$table->text('secret_key');
		$table->text('access_key');
		$table->string('ReportId',100)->default('0');
		$table->date('ReportId_updated_at')->nullable()->default(null);
		$table->integer('bp_warehouse_map_id')->nullable()->default(null);
		$table->integer('bp_warehouse_mapped_location_id')->nullable()->default(null);
		$table->integer('created_by');
		$table->integer('updated_by');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_amazon');
    }
}