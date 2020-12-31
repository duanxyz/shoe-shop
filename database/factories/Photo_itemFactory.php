<?php

namespace Database\Factories;

use App\Kasut\dummy;
use App\Models\Photo_item;
use Illuminate\Database\Eloquent\Factories\Factory;

class Photo_itemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo_item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'photo_url' => $this->faker->randomElement(dummy::itemPhotos()),
        ];
    }
}
