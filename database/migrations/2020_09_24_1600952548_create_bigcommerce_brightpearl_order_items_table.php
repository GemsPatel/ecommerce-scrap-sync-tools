<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceBrightpearlOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_brightpearl_order_items', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->bigInteger('orderId')->nullable()->default(null)->index('orderId');
		$table->string('actual_orderId',100)->nullable()->default(null)->index('actual_orderId');
		$table->bigInteger('organization_id')->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();
		$table->string('order_product_id',30)->nullable()->default(null);
		$table->string('product_id',30)->nullable()->default(null);
		$table->integer('variant_id')->nullable()->default(null);
		$table->integer('order_address_id')->nullable()->default(null);
		$table->string('name',200)->nullable()->default(null);
		$table->string('sku',50)->nullable()->default(null);
		$table->string('upc',100)->nullable()->default(null);
		$table->string('type',100)->nullable()->default(null);
		$table->decimal('base_price',10,2)->nullable()->default(null);
		$table->decimal('price_ex_tax',10,2)->nullable()->default(null);
		$table->decimal('price_tax',10,2)->nullable()->default(null);
		$table->decimal('base_total',10,2)->nullable()->default(null);
		$table->decimal('total_ex_tax',10,2)->nullable()->default(null);
		$table->decimal('total_inc_tax',10,2)->nullable()->default(null);
		$table->decimal('total_tax',10,2)->nullable()->default(null);
		$table->integer('quantity')->nullable()->default(null);
		$table->integer('bp_orderRowSequence')->nullable()->default(null);
		$table->integer('bp_productId')->nullable()->default(null);
		$table->string('bp_productName',300)->nullable()->default(null);
		$table->string('bp_productSku',30)->nullable()->default(null);
		$table->integer('bp_quantity_magnitude')->nullable()->default(null);
		$table->string('bp_itemCost_currencyCode',20)->nullable()->default(null);
		$table->decimal('bp_itemCost_value',10,2)->nullable()->default(null);
		$table->string('bp_productPrice_currencyCode',20)->nullable()->default(null);
		$table->decimal('bp_productPrice_value',10,2)->nullable()->default(null);
		$table->decimal('bp_discountPercentage',10,2)->nullable()->default(null);
		$table->decimal('bp_rowValue_taxRate',10,2)->nullable()->default(null);
		$table->string('bp_rowValue_taxCode',30)->nullable()->default(null);
		$table->string('bp_rowValue_taxCalculator',50)->nullable()->default(null);
		$table->string('bp_rowValue_rowNet_currencyCode',20)->nullable()->default(null);
		$table->decimal('bp_rowValue_rowNet_value',10,2)->nullable()->default(null);
		$table->string('bp_rowValue_rowTax_currencyCode',20)->nullable()->default(null);
		$table->decimal('bp_rowValue_rowTax_value',10,2)->nullable()->default(null);
		$table->string('bp_rowValue_taxClassId',20)->nullable()->default(null);
		$table->string('bp_nominalCode',10)->nullable()->default(null);
		$table->tinyInteger('bp_composition_bundleParent')->nullable()->default(null);
		$table->tinyInteger('bp_composition_bundleChild')->nullable()->default(null);
		$table->integer('bp_composition_parentOrderRowId')->nullable()->default(null);
		$table->integer('bp_rowId')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_brightpearl_order_items');
    }
}