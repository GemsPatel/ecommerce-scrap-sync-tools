<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountBrightpearlAppTable extends Migration
{
    public function up()
    {
        Schema::create('account_brightpearl_app', function (Blueprint $table) {

		$table->increments('id');
		$table->text('app_ref')->nullable()->default(null);
		$table->text('account_code')->nullable()->default(null);
		$table->text('client_id')->nullable()->default(null);
		$table->text('client_secret')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_brightpearl_app');
    }
}