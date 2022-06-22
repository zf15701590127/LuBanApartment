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
        Schema::create('room_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->comment('所属项目 ID');
            $table->integer('building_id')->unsigned()->comment('楼栋 ID');
            $table->integer('room_id')->unsigned()->comment('房间 ID');
            $table->integer('contract_type_id')->unsigned()->comment('合同类型 ID');
            $table->decimal('cold_water_read')->unsigned()->comment('冷水表读书');
            $table->decimal('electric_read')->unsigned()->comment('电表度数');
            $table->decimal('wallet')->unsigned()->comment('钱包');
            $table->integer('first_begin_date')->unsigned()->comment('首次入住时间');
            $table->integer('begin_date')->unsigned()->comment('开始时间');
            $table->integer('end_date')->unsigned()->comment('结束时间');
            $table->integer('pay_status')->unsigned()->comment('支付状态,已支付1,未支付2，部分支付3');
            $table->string('name')->comment('签约人姓名');
            $table->string('mobile_phone_number')->comment('签约手机号码');
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
        Schema::dropIfExists('room_customers');
    }
};
