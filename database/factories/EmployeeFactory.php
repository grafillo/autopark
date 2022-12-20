<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'patronim' => fake()->firstName(),
            'class_level' => rand(1,5),
        ];
    }
}
