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
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('deposit', 11, 2)->unsigned()->comment('定金');
            $table->decimal('cold_water_fee', 11, 2)->unsigned()->comment('冷水费');
            $table->decimal('electricity_fee', 11, 2)->unsigned()->comment('电费');
            $table->decimal('change_room_fee', 11, 2)->unsigned()->comment('换房费');
            $table->integer('project_id')->unsigned()->comment('关联所属项目');
            $table->SoftDeletes();
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
        Schema::dropIfExists('prices');
    }
};
