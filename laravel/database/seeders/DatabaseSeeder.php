<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 本番環境でも実行
        $this->call(PrefectureSeeder::class);

        if (config("app.env") !== "production") {
            // 本番環境以外で実行
            $this->call(AdminSeeder::class);
            $this->call(UserSeeder::class);
            $this->call(ProfileSeeder::class);
            $this->call(ProductCategorySeeder::class);
            $this->call(ProductSeeder::class);
            $this->call(OrderSeeder::class);
        }
    }
}
