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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_customer_id')->unsigned()->comment('房间客户ID');
            $table->integer('contract_id')->unsigned()->comment('合同ID');
            $table->integer('accounting_subject_id')->unsigned()->comment('订单类型，1:押金，2：合同租金');
            $table->decimal('including_tax_price', 11, 2)->unsigned()->comment('含税价');
            $table->decimal('paid_amount', 11, 2)->unsigned()->comment('已支付金额');
            $table->decimal('unpaid_amount', 11, 2)->unsigned()->comment('未支付金额');
            $table->decimal('tax_amount', 11, 2)->unsigned()->comment('税金');
            $table->decimal('tax_rate', 11, 2)->unsigned()->comment('税率');
            $table->decimal('excluding_tax_price', 11, 2)->unsigned()->comment('不含税金额');
            $table->integer('begin_date')->unsigned()->comment('开始时间');
            $table->integer('end_date')->unsigned()->comment('结束日期');
            $table->integer('pay_status')->unsigned()->comment('支付状态,已支付1,未支付2，部分支付3');
            $table->integer('payment_id')->unsigned()->comemtn('收款 ID');
            $table->integer('is_visible')->unsigned()->comment('客户是否可见,1可见，2不可见');
            $table->integer('project_id')->unsigned()->comment('所属项目 ID');
            $table->integer('room_id')->unsigned()->comment('所属房间 ID');
            $table->integer('is_must_pay')->unsigned()->comment('必须支付，1必须，2非必须');
            $table->timestamps();
            $table->softDeletes();
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
};
