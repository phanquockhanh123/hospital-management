<?php

namespace Database\Factories;

use App\Models\BloodDonor;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloodDonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bloodDonorIds = BloodDonor::pluck('id');
        return [
            'blood_donor_id' => $bloodDonorIds->random(),
            'bags' => $this->faker->numberBetween(1, 20)
        ];
    }
}
