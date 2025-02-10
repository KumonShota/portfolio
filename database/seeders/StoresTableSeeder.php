<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('stores')->insert([
            ['region_id' => 1, 'name' => '札幌ラーメン店', 'place' => '北海道札幌市'],
            ['region_id' => 3, 'name' => '東京タワーカフェ', 'place' => '東京都港区'],
            ['region_id' => 5, 'name' => '大阪串カツ店', 'place' => '大阪府大阪市'],
            ['region_id' => 8, 'name' => '福岡もつ鍋屋', 'place' => '福岡県福岡市'],
        ]);
    }
}
