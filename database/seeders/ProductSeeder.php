<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'サンプルTシャツ',
                'val' => 2000,
                'explanation' => 'これはサンプルのTシャツです。',
                'picture' => 'images/apparel1.jpg',
                'genre' => 't-shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'サンプルジャケット',
                'val' => 5000,
                'explanation' => 'これはサンプルのジャケットです。',
                'picture' => 'images/apparel14.jpg',
                'genre' => 'jacket',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'サンプルウォッチ',
                'val' => 10000,
                'explanation' => 'これはサンプルのウォッチです。',
                'picture' => 'images/apparel9.jpg',
                'genre' => 'accessory',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
