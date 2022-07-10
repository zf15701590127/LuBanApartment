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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id')->unsigned()->comment('关联楼栋 ID');
            $table->string('name')->comment('房间名称');
            $table->integer('floor')->comment('楼层');
            $table->integer('purpose_id')->unsigned()->comment('关联房间用途 ID');
            $table->integer('status_mark')->unsigned()->comment('状态标志 0:空房；1:维修；2:脏房；3:已预定;4:已出租');
            $table->integer('reserve_id')->unsigned()->comment('关联预定主键 ID');
            $table->integer('contract_id')->unsigned()->comment('关联合同主键 ID');
            $table->decimal('benchmark_price', 11, 2)->comment('基准价格');
            $table->decimal('store_price', 11, 2)->comment('门店价格');
            $table->integer('area')->unsigned()->comment('房间面积');
            $table->integer('move_out_date')->unsigned()->comment('搬离时间');
            $table->integer('project_id')->unsigned()->comment('关联所属项目 ID');
            $table->integer('order')->comment('排序号');
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
        Schema::dropIfExists('rooms');
    }
};
