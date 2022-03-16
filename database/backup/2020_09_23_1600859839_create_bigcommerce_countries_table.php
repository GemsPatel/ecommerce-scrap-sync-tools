<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_countries', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->string('country',300)->nullable()->default(null);
		$table->string('country_iso2',5)->nullable()->default(null);
		$table->string('country_iso3',10)->nullable()->default(null);
		$table->integer('countryId')->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();
		$table->bigInteger('organization_id')->default('0');

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_countries');
    }
}