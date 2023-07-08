<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('costs')->insert([
            ['cost' => '0 ~ 10000'],
            ['cost' => '10000 ~ 20000'],
           ['cost' => '20000 ~ 30000'],
           ['cost' => '30000 ~ 40000'],
           ['cost' => '40000 ~ 50000'],
           ['cost' => '50000 ~ 60000'],
           ['cost' => '60000 ~ 70000'],
           ['cost' => '700000 ~ 80000'],
           ]);
    }
}
