<?php

namespace Database\Factories;

use App\Models\Runner;
use Illuminate\Database\Eloquent\Factories\Factory;

class RunnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Runner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'birthday' => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            'cpf' => $this->faker->numerify('###########'),
        ];
    }
}
