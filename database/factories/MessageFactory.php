<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'from' => rand(1, 10),
            'to' => rand(1, 10),
            'message' => $this->faker->text(20),
            'is_read'=>rand(0,1),
        ];
    }
}
