<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // truncate tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\DoctorDepartment::truncate();
        \App\Models\Medical::truncate();
        \App\Models\MedicalDevice::truncate();
        \App\Models\Service::truncate();
        \App\Models\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // call seeder class
        $this->call([
            DoctorDepartmentSeeder::class,
            MedicalSeeder::class,
            ServiceSeeder::class,
            MedicalDeviceSeeder::class,
            UserSeeder::class,
        ]);
    }
}
