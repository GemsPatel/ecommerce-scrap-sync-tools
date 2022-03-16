<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceProductOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_product_options', function (Blueprint $table) {

		$table->increments('id');
		$table->string('optionId',30)->nullable()->default(null);
		$table->string('label',150)->nullable()->default(null);
		$table->string('option_display_name',200)->nullable()->default(null);
		$table->string('option_id',10)->nullable()->default(null);
		$table->string('product_id',10)->nullable()->default(null);
		$table->string('variant_id',10)->nullable()->default(null);
		$table->string('productId',10)->nullable()->default(null);
		$table->bigInteger('organization_id')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_product_options');
    }
}