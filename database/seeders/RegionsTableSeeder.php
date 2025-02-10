<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('regions')->insert([
            ['name' => '北海道'],
            ['name' => '東北'],
            ['name' => '関東'],
            ['name' => '中部'],
            ['name' => '近畿'],
            ['name' => '中国'],
            ['name' => '四国'],
            ['name' => '九州'],
        ]);
    }
}
