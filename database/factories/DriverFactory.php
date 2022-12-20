<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class DriverFactory extends Factory
{

    public function definition()
    {
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'patronim' => fake()->firstName(),
            'experience' => rand(1,8)
        ];
    }
}


