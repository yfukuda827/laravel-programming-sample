<?php

namespace Database\Seeders;

use App\Models\Prefecture;
use Illuminate\Database\Seeder;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => '北海道', 'shipping_charge' => 1100,],
            ['id' => 2, 'name' => '青森県', 'shipping_charge' => 990,],
            ['id' => 3, 'name' => '岩手県', 'shipping_charge' => 990,],
            ['id' => 4, 'name' => '宮城県', 'shipping_charge' => 990,],
            ['id' => 5, 'name' => '秋田県', 'shipping_charge' => 990,],
            ['id' => 6, 'name' => '山形県', 'shipping_charge' => 990,],
            ['id' => 7, 'name' => '福島県', 'shipping_charge' => 990,],
            ['id' => 8, 'name' => '茨城県', 'shipping_charge' => 990,],
            ['id' => 9, 'name' => '栃木県', 'shipping_charge' => 990,],
            ['id' => 10, 'name' => '群馬県', 'shipping_charge' => 990,],
            ['id' => 11, 'name' => '埼玉県', 'shipping_charge' => 990,],
            ['id' => 12, 'name' => '千葉県', 'shipping_charge' => 990,],
            ['id' => 13, 'name' => '東京都', 'shipping_charge' => 990,],
            ['id' => 14, 'name' => '神奈川県', 'shipping_charge' => 990,],
            ['id' => 15, 'name' => '新潟県', 'shipping_charge' => 990,],
            ['id' => 16, 'name' => '富山県', 'shipping_charge' => 990,],
            ['id' => 17, 'name' => '石川県', 'shipping_charge' => 990,],
            ['id' => 18, 'name' => '福井県', 'shipping_charge' => 990,],
            ['id' => 19, 'name' => '山梨県', 'shipping_charge' => 990,],
            ['id' => 20, 'name' => '長野県', 'shipping_charge' => 990,],
            ['id' => 21, 'name' => '岐阜県', 'shipping_charge' => 990,],
            ['id' => 22, 'name' => '静岡県', 'shipping_charge' => 990,],
            ['id' => 23, 'name' => '愛知県', 'shipping_charge' => 990,],
            ['id' => 24, 'name' => '三重県', 'shipping_charge' => 990,],
            ['id' => 25, 'name' => '滋賀県', 'shipping_charge' => 990,],
            ['id' => 26, 'name' => '京都府', 'shipping_charge' => 990,],
            ['id' => 27, 'name' => '大阪府', 'shipping_charge' => 990,],
            ['id' => 28, 'name' => '兵庫県', 'shipping_charge' => 990,],
            ['id' => 29, 'name' => '奈良県', 'shipping_charge' => 990,],
            ['id' => 30, 'name' => '和歌山県', 'shipping_charge' => 990,],
            ['id' => 31, 'name' => '鳥取県', 'shipping_charge' => 990,],
            ['id' => 32, 'name' => '島根県', 'shipping_charge' => 990,],
            ['id' => 33, 'name' => '岡山県', 'shipping_charge' => 990,],
            ['id' => 34, 'name' => '広島県', 'shipping_charge' => 990,],
            ['id' => 35, 'name' => '山口県', 'shipping_charge' => 990,],
            ['id' => 36, 'name' => '徳島県', 'shipping_charge' => 990,],
            ['id' => 37, 'name' => '香川県', 'shipping_charge' => 990,],
            ['id' => 38, 'name' => '愛媛県', 'shipping_charge' => 990,],
            ['id' => 39, 'name' => '高知県', 'shipping_charge' => 990,],
            ['id' => 40, 'name' => '福岡県', 'shipping_charge' => 990,],
            ['id' => 41, 'name' => '佐賀県', 'shipping_charge' => 990,],
            ['id' => 42, 'name' => '長崎県', 'shipping_charge' => 990,],
            ['id' => 43, 'name' => '熊本県', 'shipping_charge' => 990,],
            ['id' => 44, 'name' => '大分県', 'shipping_charge' => 990,],
            ['id' => 45, 'name' => '宮崎県', 'shipping_charge' => 990,],
            ['id' => 46, 'name' => '鹿児島県', 'shipping_charge' => 990,],
            ['id' => 47, 'name' => '沖縄県', 'shipping_charge' => 1100,],
        ];

        Prefecture::upsert($data, ['id'], ['name', 'shipping_charge']);
    }
}
