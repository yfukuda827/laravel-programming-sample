<?php

namespace Database\Factories;

use App\Models\Prefecture;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->with('profile')->first();
        $orders = $this->faker->randomDigitNotNull();
        $product = Product::inRandomOrder()->first();
        $prefecture = Prefecture::inRandomOrder()->first();
        $tax_rate = config('tax.rate');
        $tax = ceil($product->price * $orders * ($tax_rate) / 100);
        $subtotal = $product->price * $orders + $tax;
        $total = $subtotal + $prefecture->shipping_charge;

        return [
            'user_id' => $user->id,
            'product_name' => $product->name,
            'price' => $product->price,
            'orders' => $orders,
            'tax_rate' => $tax_rate,
            'tax' => $tax, 
            'subtotal' => $subtotal,
            'shipping_charge' => $prefecture->shipping_charge,
            'total' => $total,
            'payment' => $this->faker->randomElement(['bank', 'daibiki']),
            'name' => $user->name,
            'postcode' => $user->profile->postcode,
            'prefecture_id' => $user->profile->prefecture_id,
            'address' => $user->profile->address,
            'tel' => $user->profile->tel, 
        ];
    }
}
