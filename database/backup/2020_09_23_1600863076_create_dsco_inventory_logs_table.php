<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDscoInventoryLogsTable extends Migration
{
    public function up()
    {
        Schema::create('dsco_inventory_logs', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('sku',100)->nullable()->default(null);
		$table->string('title')->nullable()->default(null);
		$table->string('description',500)->nullable()->default(null);
		$table->datetime('process_at')->nullable()->default(null);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('dsco_inventory_logs');
    }
}