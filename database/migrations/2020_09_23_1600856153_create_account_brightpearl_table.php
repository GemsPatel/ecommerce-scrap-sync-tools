<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountBrightpearlTable extends Migration
{
    public function up()
    {
        Schema::create('account_brightpearl', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('account_code',100)->nullable()->default(null);
		$table->text('app_ref');
		$table->text('account_token');
		$table->text('access_token')->nullable()->default(null);
		$table->text('refresh_token')->nullable()->default(null);
		$table->string('installation_instance_id',20)->nullable()->default(null);
		$table->string('token_type',100)->nullable()->default(null);
		$table->bigInteger('expires_in')->nullable()->default(null);
		$table->string('api_domain',200)->nullable()->default(null);
		$table->integer('created_by');
		$table->integer('updated_by');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_brightpearl');
    }
}