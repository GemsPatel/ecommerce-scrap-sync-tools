<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDscoWarehousesTable extends Migration
{
    public function up()
    {
        Schema::create('dsco_warehouses', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('dsco_account_user',55)->nullable()->default(null);
		$table->string('warehouse_code',333)->nullable()->default(null);
		$table->string('warehouse_code_id',333)->nullable()->default(null);
		$table->integer('map_id')->default('0');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('dsco_warehouses');
    }
}