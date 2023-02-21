<?php

namespace Database\Seeders;

use App\Models\BloodDonation;
use Illuminate\Database\Seeder;

class BloodDonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BloodDonation::factory()->count(30)->create();
    }
}
