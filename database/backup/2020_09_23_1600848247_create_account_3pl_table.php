<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccount3plTable extends Migration
{
    public function up()
    {
        Schema::create('account_3pl', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->text('ClientId');
		$table->text('ClientSecret');
		$table->text('tpl');
		$table->text('user_login_id')->nullable()->default(null);
		$table->text('access_token')->nullable()->default(null);
		$table->integer('created_by');
		$table->integer('updated_by');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();
		$table->string('customer_id',100)->nullable()->default(null);
		$table->string('facility_id',100)->nullable()->default(null);
		$table->tinyInteger('status')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_3pl');
    }
}