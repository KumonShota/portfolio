<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('favorites')->insert([
            ['review_id' => 1, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['review_id' => 2, 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
