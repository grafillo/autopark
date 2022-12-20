<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TravelFactory extends Factory
{
    public function definition()
    {
        return [
            'car_id' => rand(1, 10),
            'employeer_id' => rand(1, 10),
            'start' => date_create(),
            'end' => date_create(),
        ];
    }
}
