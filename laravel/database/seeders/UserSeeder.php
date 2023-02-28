<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'user_test@redoit.tech',
            'name' => '開発 手巣斗',
        ]);
        User::factory()->create([
            'email' => 'user_test2@redoit.tech',
            'name' => 'テストサンプル',
            'password' => Hash::make('123abcABC'),
        ]);
        User::factory()->create([
            'email' => 'test2@redoit.tech',
            'name' => '試験花子',
            'password' => Hash::make('password'),
        ]);

        User::factory()->count(50)->create();
    }
}
