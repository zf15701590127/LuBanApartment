<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountingSubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounting_subjects')->insert([
            ['name' => '定金'],
            ['name' => '合同租金'],
            ['name' => '押金'],
            ['name' => '冷水费'],
            ['name' => '热水费'],
            ['name' => '电费'],
            ['name' => '宽带费'],
            ['name' => '停车费'],
            ['name' => '换房费'],
            ['name' => '赔偿费'],
            ['name' => '罚没押金'],
            ['name' => '滞纳金'],
            ['name' => '优惠券'],
            ['name' => '清洁费'],
            ['name' => '服务费'],
            ['name' => '短租租金'],
            ['name' => '罚没定金'],
            ['name' => '租金账户结转'],
            ['name' => '转租费'],
            ['name' => '罚没租金']
        ]);
    }
}
