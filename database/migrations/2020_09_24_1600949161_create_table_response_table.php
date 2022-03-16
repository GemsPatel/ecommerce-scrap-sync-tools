<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableResponseTable extends Migration
{
    public function up()
    {
        Schema::create('table_response', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->bigInteger('orderId')->nullable()->default(null);
		$table->text('response')->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();
		$table->integer('orgnization_id')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('table_response');
    }
}