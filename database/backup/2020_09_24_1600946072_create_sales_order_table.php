<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderTable extends Migration
{
    public function up()
    {
        Schema::create('sales_order', function (Blueprint $table) {

		$table->increments('id');
		$table->bigInteger('sales_order_id')->index('sales_order_id');
		$table->bigInteger('contactId');
		$table->string('order_id',100)->index('order_id');
		$table->date('date_created');
		$table->double('total_amount', 10, 5);
		$table->string('status',50)->default('Pending');
		$table->text('reason')->nullable()->default(null);
		$table->bigInteger('shopify_order_number')->nullable()->default(null);
		$table->enum('sync_with_customer',['No','Yes'])->default('No');
		$table->integer('active')->default('1');
		$table->enum('created_via',['shopify'])->default('shopify');
		$table->integer('organization_id')->index('organization_id');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_order');
    }
}