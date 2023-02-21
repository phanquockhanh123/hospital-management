<?php

namespace Database\Seeders;

use App\Models\BloodDonor;
use Illuminate\Database\Seeder;

class BloodDonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BloodDonor::factory()->count(30)->create();
    }
}
