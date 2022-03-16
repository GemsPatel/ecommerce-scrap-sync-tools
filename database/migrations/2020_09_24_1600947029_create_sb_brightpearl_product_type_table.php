<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbBrightpearlProductTypeTable extends Migration
{
    public function up()
    {
        Schema::create('sb_brightpearl_product_type', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->bigInteger('product_type_id');
		$table->string('product_type_name',333)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_brightpearl_product_type');
    }
}