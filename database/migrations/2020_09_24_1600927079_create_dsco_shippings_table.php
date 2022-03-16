<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDscoShippingsTable extends Migration
{
    public function up()
    {
        Schema::create('dsco_shippings', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('ship_carrier',333)->nullable()->default(null);
		$table->string('ship_method',333)->nullable()->default(null);
		$table->integer('map_id')->default('0');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('dsco_shippings');
    }
}