<?php

namespace Database\Factories;

use App\Models\BloodGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doctorDepartmentIds = \App\Models\DoctorDepartment::pluck('id');
        return [
            'name' => $this->faker->name(),
            'doctor_department_id' => $doctorDepartmentIds->random(),
            'blood_group' => $this->faker->randomElement(array_keys(\App\Models\Doctor::$bloodGroups)),
            'email' => $this->faker->unique()->email(),
            'designation' => $this->faker->text(20),
            'phone' => $this->faker->numerify('0#########'),
            'academic_level'  => $this->faker->randomElement(array_keys(\App\Models\Doctor::$academicLevels)),
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(array_keys(\App\Models\Doctor::$genders)),
            'status' => $this->faker->randomElement(array_keys(\App\Models\Doctor::$status)),
            'address' => $this->faker->address(),
            'identity_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'identity_card_date'  => $this->faker->date(),
            'identity_card_place' => $this->faker->address(),
            'start_work_date'  => $this->faker->date(),
            'specialist' => $this->faker->text(10),
        ];
    }
}
