<?php

namespace Database\Factories;

use App\Kasut\dummy;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'photo' => $this->faker->randomElement(dummy::profiles()),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null),

        ];
    }
}
