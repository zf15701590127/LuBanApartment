<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketingChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marketing_channels')->insert([
            ['name' => '58品牌公寓'],
            ['name' => '贝壳'],
            ['name' => '线下中介'],
            ['name' => '上门散客'],
            ['name' => '老带新'],
        ]);
    }
}
