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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->common('用户名');
            $table->string('email')->unique()->common('邮箱');
            $table->string('avatar')->nullable()->common('头像');
            $table->string('password')->common('密码');
            $table->boolean('is_admin')->default(false)->common('是否是管理员');
            $table->rememberToken()->common('记住我令牌');
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
        Schema::dropIfExists('users');
    }
};
