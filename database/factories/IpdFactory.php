<?php

namespace Database\Factories;

use App\Models\Bed;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class IpdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $patientIds = Patient::pluck('id');
        $doctorIds = Doctor::pluck('id');
        $bedIds = Bed::pluck('id');
        return [
            'ipd_code' =>'IPD' . $this->faker->unique()->numberBetween(100000, 999999),
            'patient_id'  => $patientIds->random(), 
            'doctor_id'=> $doctorIds->random(), 
            'bed_id'=> $bedIds->random(), 
            'blood_group' => $this->faker->randomElement(array_keys(\App\Models\Ipd::$bloodGroups)),
            'height' => $this->faker->numberBetween(100, 200),
            'weight'=> $this->faker->numberBetween(10, 200),
            'blood_pressure' => $this->faker->numberBetween(10, 200),
            'addmission_date' => $this->faker->date(),
            'symptoms' => $this->faker->text(30),
            'notes'=> $this->faker->text(100),
            'patient_status' => $this->faker->randomElement(array_keys(\App\Models\Ipd::$patientStatus)),
            'is_old_patient' => $this->faker->randomElement(array_keys(\App\Models\Ipd::$isOldPatient)),
        ];
    }
}
