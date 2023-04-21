<?php

namespace Database\Factories;

use App\Models\DoctorDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalDeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $departmentIds = DoctorDepartment::pluck('id');
        return [
            'medical_device_code' => 'DEV' . $this->faker->unique()->numberBetween(100000, 999999),
            'name' => $this->faker->name(),
            'department_id' => $departmentIds->random(),
            'status' => $this->faker->randomElement(array_keys(\App\Models\MedicalDevice::$status)),
            'expired_date' => $this->faker->date(),
            'quantity' => $this->faker->numberBetween(5, 10),
            'description' => $this->faker->text(30),
        ];
    }
}
