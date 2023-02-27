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
        \App\Models\Doctor::truncate();
        \App\Models\Bed::truncate();
        \App\Models\Patient::truncate();
        \App\Models\AddmissionPatient::truncate();
        \App\Models\Appointment::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // call seeder class
        $this->call([
            DoctorDepartmentSeeder::class,
            DoctorSeeder::class,
            BedSeeder::class,
            PatientSeeder::class,
            AddmissionPatientSeeder::class,
            AppointmentSeeder::class,
        ]);
    }
}
