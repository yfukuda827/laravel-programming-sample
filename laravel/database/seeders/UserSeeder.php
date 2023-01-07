<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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

        User::factory()->count(50)->create();
    }
}
