<?php

namespace Database\Factories;

use App\Models\Bed;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddmissionPatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doctorIds = Doctor::pluck('id');
        $patientIds = Patient::pluck('id');
        $bedIds = Bed::pluck('id');
        return [
            'doctor_id' => $doctorIds->random(),
            'patient_id' => $patientIds->random(),
            'bed_id' => $bedIds->random(),
            'addmission_date' => $this->faker->date(),
            'reason' => $this->faker->realText(50),
            'health_condition' => $this->faker->realText(50),
            'guardian_name' => $this->faker->name(),
            'guardian_relation' => $this->faker->realText(10) ,
            'guardian_contact' => $this->faker->numerify('0#########'),
            'guardian_address' => $this->faker->address(),
            'status' => $this->faker->randomElement(array_keys(\App\Models\AddmissionPatient::$status)),
            'description' => $this->faker->realText(50),
        ];
    }
}
