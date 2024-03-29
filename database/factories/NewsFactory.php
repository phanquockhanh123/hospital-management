<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'content' => $this->faker->text(100),
            'submitted_date' => $this->faker->date(),
            'source_news' => $this->faker->text(20),
            'author' => $this->faker->name(),
            'priority_level' => $this->faker->randomElement(array_keys(\App\Models\News::$priorityLevels)),
            'key_words' => $this->faker->text(10),
            'status' => $this->faker->randomElement(array_keys(\App\Models\News::$status)),
        ];
    }
}
