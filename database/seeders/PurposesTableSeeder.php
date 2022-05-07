<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurposesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purposes = [
            [
                'name' => '长租房',
            ],
            [
                'name' => '自用房',
            ],
            [
                'name' => '员工宿舍',
            ],
        ];

        DB::table('purposes')->insert($purposes);
    }
}
