<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificateTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certificate_types')->insert([
            ['name' => '身份证'],
            ['name' => '护照'],
            ['name' => '回乡证'],
            ['name' => '台胞证'],
            ['name' => '港澳台通行证'],
            ['name' => '其他']
        ]);
    }
}
