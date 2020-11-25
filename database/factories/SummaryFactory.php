<?php

namespace Database\Factories;

use App\Models\Summary;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SummaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Summary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'folder' => $this->faker->randomElement($array = [
                "SE","AI","CC","CN","IoT","OSC"
            ]),
            'title' => $this->faker->safeColorName,
            'content' => $this->faker->realText($maxNbChars = 2000),
            'user_id' => $this->faker->numberBetween($min=1, $max=2)
        ];
    }
}
