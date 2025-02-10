<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'store_id' => 1, // お気に入りの店
                'name' => '山田 太郎',
                'email' => 'taro.yamada@example.com',
                'age' => 30,
                'sex' => 'male',
                'image' => 'profile1.jpg', // プロフィール画像
                'password' => Hash::make('password'), // ハッシュ化したパスワード
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 2,
                'name' => '佐藤 花子',
                'email' => 'hanako.sato@example.com',
                'age' => 25,
                'sex' => 'female',
                'image' => 'profile2.jpg',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 3,
                'name' => '鈴木 次郎',
                'email' => 'jiro.suzuki@example.com',
                'age' => 40,
                'sex' => 'male',
                'image' => null, // プロフィール画像なし
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
