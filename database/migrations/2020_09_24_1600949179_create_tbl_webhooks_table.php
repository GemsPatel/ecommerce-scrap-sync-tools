<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblWebhooksTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_webhooks', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->bigInteger('orderId')->nullable()->default(null);
		$table->string('hookName',200)->nullable()->default(null);
		$table->bigInteger('organization_id')->nullable()->default(null);
		$table->string('platform',50)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_webhooks');
    }
}