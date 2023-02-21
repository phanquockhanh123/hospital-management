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
        $bloodGroupIds = BloodGroup::pluck('id');
        $files = config('const.application_cv_file_extension');
        return [
            'name' => $this->faker->name(),
            'doctor_department_id' => $doctorDepartmentIds->random(),
            'blood_group_id' => $bloodGroupIds->random(),
            'email' => $this->faker->unique()->email(),
            'designation' => $this->faker->text(20),
            'phone' => $this->faker->numerify('0#########'),
            'academic_level'  => $this->faker->randomElement(array_keys(\App\Models\Doctor::$academicLevels)),
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(array_keys(\App\Models\Doctor::$genders)),
            'status' => $this->faker->randomElement(array_keys(\App\Models\Doctor::$status)),
            'profile'  => sprintf('images/', $this->faker->uuid(), $this->faker->randomElement($files)),
            'address' => $this->faker->address(),
        ];
    }
}
