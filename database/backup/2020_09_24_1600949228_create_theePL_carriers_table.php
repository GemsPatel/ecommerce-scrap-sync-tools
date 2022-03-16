<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheePLCarriersTable extends Migration
{
    public function up()
    {
        Schema::create('theePL_carriers', function (Blueprint $table) {

		$table->increments('id');
		$table->string('carriers_name',50);
		$table->string('service_name',150);
		$table->string('service_code',11);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();
		$table->bigInteger('organization_id')->default('2');

        });
    }

    public function down()
    {
        Schema::dropIfExists('theePL_carriers');
    }
}