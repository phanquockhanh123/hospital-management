<?php

namespace Database\Factories;

use App\Models\BloodGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloodDonorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bloodGroupIds = BloodGroup::pluck('id');
        return [
            'name' => $this->faker->name(),
            'date_of_birth'=> $this->faker->date(),
            'gender' => $this->faker->randomElement(array_keys(\App\Models\BloodDonor::$genders)),
            'blood_group_id' => $bloodGroupIds->random(),
        ];
    }
}
