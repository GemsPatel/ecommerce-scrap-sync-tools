<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsSourceTable extends Migration
{
    public function up()
    {
        Schema::create('items_source', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id')->index('organization_id');
		$table->string('item_id',225)->nullable()->default(null);
		$table->string('name');
		$table->double('price', 10, 5)->nullable()->default(null);
		$table->string('SKU',100)->nullable()->default(null);
		$table->string('unit',50)->nullable()->default(null);
		$table->string('upc',50)->nullable()->default(null);
		$table->text('description')->nullable()->default(null);
		$table->string('SupplierPartAuxiliaryID',50)->nullable()->default(null);
		$table->string('Classification',50)->nullable()->default(null);
		$table->string('barcode',50)->nullable()->default(null);
		$table->bigInteger('variants_id')->default('0');
		$table->string('ASIN',55)->nullable()->default(null);
		$table->enum('created_via',['3pl','ariba','coupa','shopify','amazon','dsco','ebay']);
		$table->integer('map_status')->default('0')->index('map_status');
		$table->integer('map_id')->default('0')->index('map_id');
		$table->enum('is_package',['No','Yes'])->default('No');
		$table->integer('pack_size')->default('0');
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('items_source');
    }
}