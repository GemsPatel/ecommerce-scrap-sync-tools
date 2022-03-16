<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountCoupaTable extends Migration
{
    public function up()
    {
        Schema::create('account_coupa', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->text('From_Identity');
		$table->text('To_Identity');
		$table->text('Sender_Identity');
		$table->text('Sender_SharedSecret');
		$table->string('payloadID')->nullable()->default(null);
		$table->integer('created_by');
		$table->integer('updated_by');
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('account_coupa');
    }
}