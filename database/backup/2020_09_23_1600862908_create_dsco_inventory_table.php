<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDscoInventoryTable extends Migration
{
    public function up()
    {
        Schema::create('dsco_inventory', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('dsco_account_user',225)->nullable()->default(null);
		$table->string('sku',100)->nullable()->default(null);
		$table->string('title')->nullable()->default(null);
		$table->string('ean',100)->nullable()->default(null);
		$table->string('upc',100)->nullable()->default(null);
		$table->string('mpn',111)->nullable()->default(null);
		$table->string('gtin',111)->nullable()->default(null);
		$table->string('isbn',111)->nullable()->default(null);
		$table->string('partner_sku',111)->nullable()->default(null);
		$table->string('brand',111)->nullable()->default(null);
		$table->integer('quantity_available')->nullable()->default(null);
		$table->string('stock_status',55)->nullable()->default(null);
		$table->string('warehouse_dsco_id_1',100)->nullable()->default(null);
		$table->string('warehouse_code_1',100)->nullable()->default(null);
		$table->integer('warehouse_quantity_1')->nullable()->default(null);
		$table->string('warehouse_dsco_id_2',100)->nullable()->default(null);
		$table->string('warehouse_code_2',100)->nullable()->default(null);
		$table->integer('warehouse_quantity_2')->nullable()->default(null);
		$table->string('warehouse_dsco_id_3',100)->nullable()->default(null);
		$table->string('warehouse_code_3',100)->nullable()->default(null);
		$table->integer('warehouse_quantity_3')->nullable()->default(null);
		$table->enum('synced_status',['Pending','Processing','Synced'])->nullable()->default(null);
		$table->datetime('last_updated_at')->nullable()->default(null);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('dsco_inventory');
    }
}