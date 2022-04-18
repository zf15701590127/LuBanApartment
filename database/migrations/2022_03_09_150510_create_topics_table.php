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
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->common('话题标题');
            $table->text('body')->common('话题内容');
            $table->integer('user_id')->unsigned()->common('用户 ID');
            $table->integer('topic_category_id')->unsigned()->common('话题分类 ID');
            $table->integer('order')->unsigned()->common('话题排序');
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
        Schema::dropIfExists('topics');
    }
};
