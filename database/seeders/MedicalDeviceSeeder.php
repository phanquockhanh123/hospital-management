<?php

namespace Database\Seeders;

use App\Models\MedicalDevice;
use Illuminate\Database\Seeder;

class MedicalDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MedicalDevice::factory()->count(10)->create();
    }
}
