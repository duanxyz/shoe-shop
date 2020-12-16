<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoiceNo' => 'INV/20201127/XX/XI/' + $this->faker->ean8,
            'payment' => $this->faker->randomElement(['COD', 'OVO', 'DANA', 'GOPAY', 'BNI', 'BRI', 'BCA']),
            'grand_total' => $this->faker->numberBetween($min = 300000, $max = 15000000),
            'status' => $this->faker->randomElement(['Cart', 'Awaiting Payment', 'Awaiting Confirmation', 'Processed', 'Shipping', 'Delivered']),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null),
        ];
    }
}
