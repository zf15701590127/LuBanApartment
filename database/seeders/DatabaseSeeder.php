<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);
        $this->call(PurposesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(PricesTableSeeder::class);
        $this->call(AccountingSubjectsTableSeeder::class);
    }
}
