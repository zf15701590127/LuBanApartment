<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaseTermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lease_terms')->insert([
            ['name' => '1个月', 'number' => 1],
            ['name' => '2个月', 'number' => 2],
            ['name' => '3个月', 'number' => 3],
            ['name' => '4个月', 'number' => 4],
            ['name' => '5个月', 'number' => 5],
            ['name' => '6个月', 'number' => 6],
            ['name' => '7个月', 'number' => 7],
            ['name' => '8个月', 'number' => 8],
            ['name' => '9个月', 'number' => 9],
            ['name' => '10个月', 'number' => 10],
            ['name' => '11个月', 'number' => 11],
            ['name' => '12个月', 'number' => 12],
            ['name' => '13个月', 'number' => 13],
            ['name' => '14个月', 'number' => 14],
            ['name' => '15个月', 'number' => 15],
            ['name' => '16个月', 'number' => 16],
            ['name' => '17个月', 'number' => 17],
            ['name' => '18个月', 'number' => 18],
            ['name' => '2年', 'number' => 24],
            ['name' => '3年', 'number' => 36],
            ['name' => '4年', 'number' => 48],
            ['name' => '5年', 'number' => 60],
        ]);
    }
}
