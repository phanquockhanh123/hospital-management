<?php

namespace Database\Seeders;

use App\Models\DoctorDepartment;
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
                'name' => 'Phòng khám nội tổng hợp ',
                'description' => 'department 1 description',
                'status' => DoctorDepartment::STATUS_FREE,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Phòng khám chuyên khoa ngoại',
                'description' => 'department 2 description',
                'status' => DoctorDepartment::STATUS_FREE,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Phòng khám chuyên khoa nội',
                'description' => 'department 3 description',
                'status' => DoctorDepartment::STATUS_FREE,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Phòng khám chuyên khoa răng – hàm – mặt',
                'description' => 'department 4 description',
                'status' => DoctorDepartment::STATUS_FREE,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Phòng khám chuyên khoa tai – mũi – họng',
                'description' => 'department 5 description',
                'status' => DoctorDepartment::STATUS_FREE,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
