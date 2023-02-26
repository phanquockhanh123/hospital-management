<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AddmissionPatient;

class AddmissionPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AddmissionPatient::factory()->count(50)->create();
    }
}
