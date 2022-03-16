<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingBigcommerceBrightpearlOrderStatusTable extends Migration
{
    public function up()
    {
        Schema::create('mapping_bigcommerce_brightpearl_order_status', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->integer('bigcom_fk_order_status_id')->nullable()->default(null);
		$table->integer('bp_fk_order_status_id')->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();
		$table->bigInteger('organization_id')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('mapping_bigcommerce_brightpearl_order_status');
    }
}