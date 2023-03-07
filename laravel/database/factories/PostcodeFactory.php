<?php

namespace Database\Factories;

use App\Models\Prefecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostcodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'postcode' => $this->faker->postcode(),
            'prefecture_id' => Prefecture::inRandomOrder()->first(),
            'address' => $this->faker->city(),
        ];
    }
}
