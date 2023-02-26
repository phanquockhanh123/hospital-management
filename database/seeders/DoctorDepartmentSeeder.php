<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DoctorDepartmentSeeder extends Seeder
{
    protected $now;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now  = now();
        \App\Models\DoctorDepartment::insert([
            [
                'name' => 'Department 1',
                'description' => 'department 1 description',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Department 2',
                'description' => 'department 2 description',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Department 3',
                'description' => 'department 3 description',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Department 4',
                'description' => 'department 4 description',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Department 5',
                'description' => 'department 5 description',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
