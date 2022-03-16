<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceOrderStatusTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_order_status', function (Blueprint $table) {

		$table->bigIncrements('id')->index('id');
		$table->string('custom_label',150)->nullable()->default(null);
		$table->string('name',150)->nullable()->default(null);
		$table->integer('order')->nullable()->default(null);
		$table->integer('status_id')->nullable()->default(null)->index('status_id');
		$table->string('system_label',150)->nullable()->default(null);
		$table->text('system_description')->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_order_status');
    }
}