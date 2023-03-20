<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doctorDepartmentIds = \App\Models\DoctorDepartment::pluck('id');
        $doctorIds = \App\Models\Doctor::pluck('id');
        $patientIds = \App\Models\Patient::pluck('id');
        return [
            'patient_id' => $patientIds->random(),
            'doctor_id' => $doctorIds->random(),
            'doctor_department_id' => $doctorDepartmentIds->random(),
            'start_time' => $this->faker->date(),
            'end_time' => $this->faker->date(),
            'description' => $this->faker->realText(100),
            'status' => $this->faker->randomElement(array_keys(\App\Models\Appointment::$status)),
        ];
    }
}
