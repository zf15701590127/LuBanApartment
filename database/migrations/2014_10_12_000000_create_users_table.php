<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
            $table->string('avatar')->default('http://qiniu.baojiagongyu.xyz/05241946722924.jpg')->common('头像');
            $table->string('password')->common('密码');
            $table->boolean('is_admin')->default(false)->common('是否是管理员');
            $table->boolean('active')->default(true)->common('是否启用');
            $table->rememberToken()->common('记住我令牌');
            $table->timestamps();
            $table->softDeletes();
        });

        $user = new User;
        $user->name = 'William';
        $user->email = '15701590127@163.com';
        $user->is_admin = 1;
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password

        $user->save();
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
