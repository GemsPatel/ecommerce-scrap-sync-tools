<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbBrightpearlProductSupplierTable extends Migration
{
    public function up()
    {
        Schema::create('sb_brightpearl_product_supplier', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->integer('product_id');
		$table->integer('supplier_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_brightpearl_product_supplier');
    }
}