<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountDscoTable extends Migration
{
    public function up()
    {
        Schema::create('account_dsco', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('account_name',100);
		$table->text('sftp_host');
		$table->text('username');
		$table->text('password');
		$table->text('latest_file')->nullable()->default(null);
		$table->integer('read_status')->default('0');
		$table->integer('dsco_brightpearl_channel')->nullable()->default(null);
		$table->string('dsco_term_type',44)->nullable()->default(null);
		$table->string('dsco_ship_from_first_name',111)->nullable()->default(null);
		$table->string('dsco_ship_from_last_name',111)->nullable()->default(null);
		$table->string('dsco_ship_from_company',111)->nullable()->default(null);
		$table->string('dsco_ship_from_address_1',111)->nullable()->default(null);
		$table->string('dsco_ship_from_address_2',111)->nullable()->default(null);
		$table->string('dsco_ship_from_city',111)->nullable()->default(null);
		$table->string('dsco_ship_from_state',111)->nullable()->default(null);
		$table->string('dsco_ship_from_zip',111)->nullable()->default(null);
		$table->string('dsco_ship_from_country',111)->nullable()->default(null);
		$table->integer('created_by');
		$table->integer('updated_by');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_dsco');
    }
}