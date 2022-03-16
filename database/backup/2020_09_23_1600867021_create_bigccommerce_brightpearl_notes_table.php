<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigccommerceBrightpearlNotesTable extends Migration
{
    public function up()
    {
        Schema::create('bigccommerce_brightpearl_notes', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->bigInteger('orderId')->nullable()->default(null)->index('orderId');
		$table->string('created_date_time',100)->nullable()->default(null);
		$table->text('note')->nullable()->default(null);
		$table->timestamp('created_at')->useCurrent();
		$table->timestamp('updated_at')->useCurrent();
		$table->string('type',30)->nullable()->default(null)->index('type');
		$table->integer('noteId')->nullable()->default(null);
		$table->bigInteger('organization_id')->nullable()->default(null)->index('organization_id');
		$table->string('note_type',30)->nullable()->default(null)->index('note_type');

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigccommerce_brightpearl_notes');
    }
}