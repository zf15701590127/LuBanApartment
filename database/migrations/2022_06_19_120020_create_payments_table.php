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
            $table->decimal('amount', 11, 2)->unsigned()->comment('付款金额');
            $table->integer('begin_date')->unsigned()->comment('账单开始时间');
            $table->integer('end_date')->unsigned()->comment('账单结束时间');
            $table->integer('room_id')->unsigned()->comment('房间 ID');
            $table->integer('project_id')->unsigned()->comment('项目 ID');
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
