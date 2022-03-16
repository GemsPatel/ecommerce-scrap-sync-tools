<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceTable extends Migration
{
    public function up()
    {
        Schema::create('sales_invoice', function (Blueprint $table) {

		$table->increments('id');
		$table->bigInteger('sales_order')->index('sales_order');
		$table->string('Invoice_no',100)->index('Invoice_no');
		$table->bigInteger('contactId');
		$table->string('order_id',100)->index('order_id');
		$table->date('date_created');
		$table->double('total_amount', 10, 5);
		$table->string('status',50)->default('Pending');
		$table->text('reason')->nullable()->default(null);
		$table->integer('active')->default('1');
		$table->enum('created_via',['ariba','coupa','dsco'])->default('ariba');
		$table->integer('organization_id')->index('organization_id');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_invoice');
    }
}