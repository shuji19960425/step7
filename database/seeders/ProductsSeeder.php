<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->insert([
            [
                'company_id' => '1',
                'product_name' => 'ゲームキューブ',
                'price' => '5000',
                'stock' => '20',
                'comment' => 'マリオパーティーが面白い',
                'img_path' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_id' => '2',
                'product_name' => 'PS4',
                'price' => '30000',
                'stock' => '10',
                'comment' => 'モンスターハンターが面白い',
                'img_path' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
             'company_id' => '3',
             'product_name' => '週刊少年ジャンプ',
             'price' => '300',
             'stock' => '40',
             'comment' => 'ワンピースが面白い',
             'img_path' => null,
             'created_at' => date('Y-m-d H:i:s'),
             'updated_at' => null,
            ],
            [
                'company_id' => '1',
                'product_name' => 'ゲームキューブ',
                'price' => '5000',
                'stock' => '50',
                'comment' => 'マリオパーティーが面白い',
                'img_path' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_id' => '2',
                'product_name' => 'PS4',
                'price' => '30000',
                'stock' => '20',
                'comment' => 'モンスターハンターが面白い',
                'img_path' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
             'company_id' => '3',
             'product_name' => '週刊少年ジャンプ',
             'price' => '300',
             'stock' => '100',
             'comment' => 'ワンピースが面白い',
             'img_path' => null,
             'created_at' => date('Y-m-d H:i:s'),
             'updated_at' => null,
            ],

        ]);
    }
}
