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
        Schema::create('reserves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->comment('所属项目 ID');
            $table->integer('lease_type_id')->unsigned()->comment('租赁类别');
            $table->integer('begin_date')->unsigned()->comment('合同开始时间');
            $table->integer('end_date')->unsigned()->comment('合同结束时间');
            $table->integer('lease_term_id')->unsigned()->comment('租期');
            $table->integer('room_id')->unsigned()->comment('房间号');
            $table->decimal('rent', 11, 2)->unsigned()->comment('租金');
            $table->integer('deposit_month_id')->unsigned()->comment('押金');
            $table->string('mobile_phone_number')->comment('移动电话');
            $table->string('name')->comment('客户姓名');
            $table->decimal('reserve_amount', 11, 2)->unsigned()->comment('定金金额');
            $table->integer('reserve_status')->unsigned()->comment('预定状态：1预定未支付，2已预定，3已签约,4已取消');
            $table->integer('room_customer_id')->unsigned()->comment('关联的房间客户表');
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
        Schema::dropIfExists('reserves');
    }
};
