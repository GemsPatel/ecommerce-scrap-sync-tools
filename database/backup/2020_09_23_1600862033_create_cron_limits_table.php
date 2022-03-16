<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronLimitsTable extends Migration
{
    public function up()
    {
        Schema::create('cron_limits', function (Blueprint $table) {

		$table->increments('id');
		$table->string('limit_from',10)->nullable()->default(null);
		$table->string('limit_to',10)->nullable()->default(null);
		$table->integer('round_rob')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('cron_limits');
    }
}