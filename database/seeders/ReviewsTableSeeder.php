<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('reviews')->insert([
            [
                'user_id' => 1,
                'store_id' => 1,
                'title' => '美味しいラーメンでした！',
                'body' => '特に味噌ラーメンが絶品でした。また行きたいです。',
                'stars' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'store_id' => 3,
                'title' => '夜景が素晴らしい',
                'body' => '東京タワーを眺めながらカフェタイムが楽しめます。',
                'stars' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
