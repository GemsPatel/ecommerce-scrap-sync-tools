<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrightpearlSoCustomFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('brightpearl_so_custom_fields', function (Blueprint $table) {

		$table->increments('id');
		$table->string('code',50)->nullable()->default(null);
		$table->string('name')->nullable()->default(null);
		$table->string('customFieldType',50)->nullable()->default(null);
		$table->text('options')->nullable()->default(null);
		$table->string('default_val_ariba',100)->nullable()->default(null);
		$table->string('default_val_coupa',100)->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->integer('organization_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('brightpearl_so_custom_fields');
    }
}