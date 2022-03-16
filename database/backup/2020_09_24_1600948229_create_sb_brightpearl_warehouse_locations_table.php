<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbBrightpearlWarehouseLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('sb_brightpearl_warehouse_locations', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->bigInteger('locationId');
		$table->bigInteger('warehouseId');
		$table->string('groupingA',333)->nullable()->default(null);
		$table->string('groupingB',333)->nullable()->default(null);
		$table->string('groupingC',333)->nullable()->default(null);
		$table->string('groupingD',333)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_brightpearl_warehouse_locations');
    }
}