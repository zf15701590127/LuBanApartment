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
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_customer_id')->unsigned()->comment('关联房间客户id');
            $table->integer('project_id')->unsigned()->comment('关联的项目 ID');
            $table->integer('building_id')->unsigned()->comment('关联的楼栋 ID');
            $table->integer('room_id')->unsigned()->comment('关联的房间 ID');
            $table->integer('lease_type_id')->unsigned()->comment('关联的租赁类型 ID');
            $table->integer('sign_contract_type_id')->unsigned()->comment('关联的签约类型 ID');
            $table->integer('contract_type_id')->unsigned()->comment('关联的合同类型 ID');
            $table->integer('user_id')->unsigned()->comment('关联用户表 ID');
            $table->integer('marketing_channel_id')->unsigned()->comment('销售渠道');
            $table->integer('begin_date')->unsigned()->comment('合同开始日期');
            $table->integer('end_date')->unsigned()->comment('合同结束日期');
            $table->integer('actual_end_date')->unsigned()->comment('实际结束日期');
            $table->integer('lease_term_id')->unsigned()->comment('租期');
            $table->integer('deposit_month_id')->unsigned()->comment('押几个月的押金');
            $table->decimal('deposit_amount', 11, 2)->unsigned()->comment('押金金额');
            $table->decimal('rent', 11, 2)->unsigned()->comment('租金');
            $table->integer('contract_customer_id')->unsigned()->comment('签约客户ID');
            $table->decimal('cold_water_read', 11, 2)->unsigned()->comment('冷水读书');
            $table->decimal('electric_read', 11, 2)->unsigned()->comment('电表度数');
            $table->integer('period_type')->unsigned()->comment('周期类型 1:跨月，2:自然月');
            $table->integer('recent_due_date')->unsigned()->comment('最近应缴费日期');
            $table->integer('reserve_id')->unsigned()->comment('关联的预定 ID');
            $table->string('remark')->comment('合同备注');
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
        Schema::dropIfExists('contracts');
    }
};
