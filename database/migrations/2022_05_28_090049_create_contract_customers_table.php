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
        Schema::create('contract_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('客户姓名');
            $table->integer('room_customer_id')->unsigned()->comment('房间客户ID');
            $table->integer('is_contractor')->unsigned()->comment('是否是签约人 1:签约人，2:同住人');
            $table->integer('certificate_type_id')->unsigned()->comment('证件类型');
            $table->string('certificate_no')->comment('证件号');
            $table->integer('sex')->unsigned()->comment('性别：1:男，2:女');
            $table->string('mobile_phone_number')->comment('手机号码');
            $table->integer('project_id')->unsigned()->comment('项目ID');
            $table->integer('room_id')->unsigned()->comment('房间ID');
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
        Schema::dropIfExists('contract_customers');
    }
};
