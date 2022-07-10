<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_customer_id')->unsigned()->comment('房间客户 ID');
            $table->integer('contract_id')->unsigned()->commment('合同 ID');
            $table->decimal('amount', 11, 2)->comment('付款金额');
            $table->integer('room_id')->unsigned()->comment('房间 ID');
            $table->integer('project_id')->unsigned()->comment('项目 ID');
            $table->string('order_no')->comment('订单流水号');
            $table->string('payment_no')->comment('支付平台订单号');
            $table->integer('payment_type_id')->unsigned()->comment('关联支付方式主键');
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
        Schema::dropIfExists('payments');
    }
};
