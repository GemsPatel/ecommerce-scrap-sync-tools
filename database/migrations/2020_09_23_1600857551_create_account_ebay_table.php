<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountEbayTable extends Migration
{
    public function up()
    {
        Schema::create('account_ebay', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('account_name',100)->nullable()->default(null);
		$table->text('refresh_token');
		$table->text('access_token');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_ebay');
    }
}