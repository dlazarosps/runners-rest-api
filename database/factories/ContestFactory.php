<?php

namespace Database\Factories;

use App\Models\Contest;
use App\Models\Race;
use App\Models\Runner;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'duration' => $this->faker->time('H:i:s.u'),
            'race_id' => $this->faker->unique(true)->numberBetween(1, Race::count()),
            'runner_id' => $this->faker->unique(true)->numberBetween(1, Runner::count()),
        ];
    }
}