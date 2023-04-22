<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScenarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // truncate tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Doctor::truncate();
        \App\Models\Patient::truncate();
        \App\Models\Appointment::truncate();
        \App\Models\News::truncate();
        \App\Models\Message::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // call seeder class
        $this->call([
            DoctorSeeder::class,
            PatientSeeder::class,
            AppointmentSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
