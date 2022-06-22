<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositMonthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deposit_months')->insert([
            ['name' => '1个月', 'number' => 1],
            ['name' => '2个月', 'number' => 2],
            ['name' => '3个月', 'number' => 3],
        ]);
    }
}
