<?php

namespace Database\Factories;

use App\Models\BedType;
use Illuminate\Database\Eloquent\Factories\Factory;

class BedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bedTypeIds = BedType::pluck('id');
        return [
            'bed_code' => 'BED' . $this->faker->unique()->numberBetween(100000, 999999),
            'name' => $this->faker->name(),
            'bed_type_id' => $bedTypeIds->random(),
            'charge' => $this->faker->numberBetween(500, 20000),
            'status' => $this->faker->randomElement(array_keys(\App\Models\Bed::$status)),
        ];
    }
}
