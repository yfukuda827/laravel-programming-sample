<?php

namespace Database\Factories;

use App\Models\Prefecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
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
            'prefecture_id' => Prefecture::inRandomOrder()->first()?->id,
            'address' => $this->faker->city() . $this->faker->streetAddress(),
            'tel' => $this->faker->phoneNumber(), 
        ];
    }
}
