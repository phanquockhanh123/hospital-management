<?php

namespace Database\Seeders;

use App\Models\BedType;
use App\Models\BloodGroup;
use App\Models\Doctor;
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
        \App\Models\BloodGroup::truncate();
        \App\Models\BloodDonor::truncate();
        \App\Models\BloodDonation::truncate();
        \App\Models\Doctor::truncate();
        \App\Models\BedType::truncate();
        \App\Models\Bed::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // call seeder class
        $this->call([
            DoctorDepartmentSeeder::class,
            BloodGroupSeeder::class,
            BloodDonorSeeder::class,
            BloodDonationSeeder::class,
            DoctorSeeder::class,
            BedTypeSeeder::class,
            BedSeeder::class,
        ]);

    }
}