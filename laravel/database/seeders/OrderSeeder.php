<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->count(2)->create([
            'user_id' => User::where('email', 'user_test@redoit.tech')->first()->id,
        ]);
        Order::factory()->count(2)->create([
            'user_id' => User::where('email', 'user_test2@redoit.tech')->first()->id,
        ]);
        Order::factory()->count(20)->create();
    }
}
