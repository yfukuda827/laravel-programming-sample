<?php

namespace Database\Seeders;

use App\Models\Postcode;
use App\Models\Prefecture;
use Illuminate\Database\Seeder;

class PostcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 初期化　テーブルを空にする
        Postcode::truncate();

        // CSVファイルの文字コードを Shift-JIS から UTF-8 に変換する
        $csvPath = storage_path('app/csv/KEN_ALL.csv');
        $convertedCsvPath = storage_path('app/csv/ken_all_utf8.csv');
        file_put_contents(
            $convertedCsvPath,
            mb_convert_encoding(
                file_get_contents($csvPath),
                'UTF-8',
                'SJIS-win'
            )
        );

        // CSVから郵便データを取得して、postcodesテーブルに登録する
        $file = new \SplFileObject($convertedCsvPath);
        $file->setFlags(\SplFileObject::READ_CSV);

        $prevPrefecture = null;
        $prefecture = null;
        foreach($file as $row) {
            if(is_null($row[0])) {
                continue;
            }
            if(Postcode::where('postcode', $row[2])->exists()) {
                continue;
            }
            if($prevPrefecture != $row[6]) {
                $prevPrefecture = $row[6];
                $prefecture = Prefecture::where('name', $row[6])->first();
            }
            Postcode::create([
                'postcode' => $row[2],
                'prefecture_id' => $prefecture->id,
                'address' => $row[7]
            ]);
        }
    }
}
