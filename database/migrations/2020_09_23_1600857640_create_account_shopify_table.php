<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountShopifyTable extends Migration
{
    public function up()
    {
        Schema::create('account_shopify', function (Blueprint $table) {
		$table->increments('id');
		$table->integer('organization_id');
		$table->string('domain',100)->nullable()->default(null);
		$table->text('access_token');
		$table->integer('created_by');
		$table->integer('updated_by');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_shopify');
    }
}