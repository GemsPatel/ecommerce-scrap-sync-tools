<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingThreeplBrightpearlShippingMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_threepl_brightpearl_shipping_methods', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->string('bp_method',200)->default('0');
		$table->string('tpl_method',200)->default('0');
		$table->string('account_no',100)->nullable()->default(null);
		$table->string('bill_code',100)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->integer('organization_id')->default('0');
		$table->string('bp_method_name',500)->nullable()->default(null);
		$table->string('tpl_method_name',500)->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_threepl_brightpearl_shipping_methods');
    }
}