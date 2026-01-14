<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->safeEmail(),
            'customer_phone' => '+91' . $this->faker->numerify('9#########'),
            'order_date' => $this->faker->dateTimeBetween('-20 days', 'now'),
            'notes' => $this->faker->sentence(),
        ];
    }
}
