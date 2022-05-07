<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->insert([
            [
                'deposit' => 1000,
                'cold_water_fee' => 6,
                'electricity_fee' => 1.3,
                'change_room_fee' => 500,
                'project_id' => 1
            ],
            [
                'deposit' => 2000,
                'cold_water_fee' => 8,
                'electricity_fee' => 1.5,
                'change_room_fee' => 1000,
                'project_id' => 2
            ],
        ]);
    }
}
