<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'name' => '火车站店',
            ],
            [
                'name' => '盛泽店',
            ],
            [
                'name' => '闵房店',
            ],
            [
                'name' => '美生慧谷店',
            ],
            [
                'name' => '富春山店',
            ],
            [
                'name' => '青才谷店',
            ],
            [
                'name' => '红庄店',
            ],
            [
                'name' => '国泰店',
            ],
            [
                'name' => '翔展店',
            ],
            [
                'name' => '游族店',
            ],
            [
                'name' => '江川路店',
            ]
        ];

        DB::table('projects')->insert($projects);
    }
}
