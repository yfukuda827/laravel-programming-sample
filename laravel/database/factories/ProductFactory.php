<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'name' => '商品'.$this->faker->randomNumber(3),
           'image_file_path' => 'images/aaa.jpg',
           'description' => $this->faker->realText(),
           'price' => $this->faker->randomNumber(4),
           'stock' => 1,
           'product_category_id' => ProductCategory::inRandomOrder()->first()?->id,
        ];
    }
}
