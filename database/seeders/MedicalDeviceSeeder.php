<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DoctorDepartment;
use App\Models\MedicalDevice;

class MedicalDeviceSeeder extends Seeder
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
        \App\Models\MedicalDevice::insert([
            [
                'medical_device_code' => 'DEV00001',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'name' => 'Máy đo huyết áp',
                'status' => MedicalDevice::STATUS_CENSORED,
                'expired_date' => '2030-01-01',
                'quantity' => 10,
                'description' => 'Dùng để đo huyết áp của bệnh nhân.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_device_code' => 'DEV00002',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'name' => 'Máy đo đường huyết',
                'status' => MedicalDevice::STATUS_CENSORED,
                'expired_date' => '2030-01-01',
                'quantity' => 10,
                'description' => 'Dùng để đo nồng độ đường huyết của bệnh nhân.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_device_code' => 'DEV00003',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'name' => 'Máy xét nghiệm',
                'status' => MedicalDevice::STATUS_CENSORED,
                'expired_date' => '2030-01-01',
                'quantity' => 10,
                'description' => 'Dùng để xét nghiệm các chỉ số máu, nước tiểu, chức năng gan, chức năng thận, và các loại xét nghiệm khác.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_device_code' => 'DEV00004',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'name' => 'Máy siêu âm',
                'status' => MedicalDevice::STATUS_CENSORED,
                'expired_date' => '2030-01-01',
                'quantity' => 10,
                'description' => 'Dùng để chẩn đoán bệnh lý bằng cách tạo ra hình ảnh bên trong cơ thể bệnh nhân.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_device_code' => 'DEV00005',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'name' => 'Máy chụp X-quang',
                'status' => MedicalDevice::STATUS_CENSORED,
                'expired_date' => '2030-01-01',
                'quantity' => 10,
                'description' => 'Dùng để chụp hình ảnh cơ thể bệnh nhân để chẩn đoán bệnh lý.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_device_code' => 'DEV00006',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'name' => 'Máy thở oxy',
                'status' => MedicalDevice::STATUS_CENSORED,
                'expired_date' => '2030-01-01',
                'quantity' => 10,
                'description' => 'Dùng để cung cấp oxy cho bệnh nhân khi họ có vấn đề về hô hấp.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_device_code' => 'DEV00007',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'name' => 'Thiết bị lấy mẫu máu',
                'status' => MedicalDevice::STATUS_CENSORED,
                'expired_date' => '2030-01-01',
                'quantity' => 10,
                'description' => 'Dùng để lấy mẫu máu của bệnh nhân để xét nghiệm.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
