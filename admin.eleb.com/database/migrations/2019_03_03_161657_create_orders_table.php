<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('shop_id');
            $table->string('sn');
            $table->string('province');
            $table->string('city');
            $table->string('county');
            $table->string('address');
            $table->string('tel');
            $table->string('name');
            $table->decimal('total');
            $table->integer('status');   //状态(-1:已取消,0:待支付,1:待发货,2:待确认,3:完成)
            $table->dateTime('order_birth_time');
            $table->string('out_trade_no');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}