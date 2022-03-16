<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbBrightpearlCustomFieldTable extends Migration
{
    public function up()
    {
        Schema::create('sb_brightpearl_custom_field', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('custom_field_code',88);
		$table->string('custom_field_name',333)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_brightpearl_custom_field');
    }
}