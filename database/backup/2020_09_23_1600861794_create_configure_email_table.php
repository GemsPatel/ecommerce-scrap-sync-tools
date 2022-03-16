<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigureEmailTable extends Migration
{
    public function up()
    {
        Schema::create('configure_email', function (Blueprint $table) {

		$table->increments('id');
		$table->string('email',300)->nullable()->default(null);
		$table->integer('status')->default('1');
		$table->datetime('created_at')->useCurrent();
		$table->bigInteger('organization_id');
		$table->timestamp('updated_at')->nullable()->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('configure_email');
    }
}