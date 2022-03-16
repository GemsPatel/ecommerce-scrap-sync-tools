<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('order_coupons', function (Blueprint $table) {

		$table->increments('id');
		$table->string('order_id',50);
		$table->integer('coupon_id');
		$table->string('code',50);
		$table->double('amount', 10, 5);
		$table->double('discount', 10, 5);
		$table->datetime('created_at')->useCurrent();
		$table->datetime('updated_at')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_coupons');
    }
}