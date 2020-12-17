<?php

namespace Database\Factories;

use App\Kasut\dummy;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween($min = 1, $max = 18),
            'name' => $this->faker->randomElement(dummy::itemNames()),
            'price' => $this->faker->numberBetween($min = 100000, $max = 15000000),
            'stock' => $this->faker->numberBetween($min = 20, $max = 150),
            'weight' => $this->faker->numberBetween($min = 400, $max = 2000),
            'condition' => $this->faker->randomElement(['Baru', 'Bekas']),
            'sold' => $this->faker->numberBetween($min = 400, $max = 2000),
            'seen' => $this->faker->numberBetween($min = 400, $max = 2000),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null),
        ];
    }
}
