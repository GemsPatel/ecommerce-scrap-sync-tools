<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigureInviteUserTable extends Migration
{
    public function up()
    {
        Schema::create('configure_invite_user', function (Blueprint $table) {

		$table->increments('id');
		$table->integer('organization_id');
		$table->string('email',100);
		$table->string('active',100)->default('0');
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('configure_invite_user');
    }
}