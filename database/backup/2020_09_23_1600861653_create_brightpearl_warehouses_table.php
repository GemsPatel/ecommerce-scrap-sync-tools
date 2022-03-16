<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrightpearlWarehousesTable extends Migration
{
    public function up()
    {
        Schema::create('brightpearl_warehouses', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->bigInteger('warehouseId')->nullable()->default(null);
		$table->string('name',200)->nullable()->default(null);
		$table->bigInteger('organization_id')->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('brightpearl_warehouses');
    }
}