<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $files = config('const.application_cv_file_extension');
        return [
            'name' => $this->faker->name(),
            'patient_code' => 'PA' . $this->faker->unique()->numberBetween(100000, 999999),
            'blood_group' => $this->faker->randomElement(array_keys(\App\Models\Doctor::$bloodGroups)),
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->numerify('0#########'),
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(array_keys(\App\Models\Doctor::$genders)),
            'profile'  => sprintf('images/', $this->faker->uuid(), $this->faker->randomElement($files)),
            'address' => $this->faker->address(),
            'identity_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'identity_card_date'  => $this->faker->date(),
            'identity_card_place' => $this->faker->address(),
        ];
    }
}
