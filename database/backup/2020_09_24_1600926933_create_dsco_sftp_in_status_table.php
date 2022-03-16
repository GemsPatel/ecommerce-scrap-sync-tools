<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDscoSftpInStatusTable extends Migration
{
    public function up()
    {
        Schema::create('dsco_sftp_in_status', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('process_type',333)->nullable()->default(null);
		$table->string('fk_process_type_ids',111);
		$table->string('dsco_account_user',77);
		$table->string('in_file_name',333)->nullable()->default(null);
		$table->enum('status',['Pending','Success'])->default('Pending');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('dsco_sftp_in_status');
    }
}