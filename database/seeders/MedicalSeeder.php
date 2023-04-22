<?php

namespace Database\Seeders;

use App\Models\Medical;
use Illuminate\Database\Seeder;
use App\Models\DoctorDepartment;

class MedicalSeeder extends Seeder
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
        \App\Models\Medical::insert([
            [
                'medical_code' => 'MED00001',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'medical_name' => 'Paracetamol',
                'unit' => 'Viên',
                'use' => 'Uống sau khi ăn',
                'quantity' => 10000,
                'import_price' => 600,
                'export_price' => 1000,
                'amount_day' => 2,
                'description' => 'Khi sử dụng thuốc hạ sốt, cần lưu ý về liều dùng vì dùng quá liều có thể gây ngộ độc, đồng thời không nên sử dụng nhiều loại thuốc hạ sốt trong một đợt sốt.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_code' => 'MED00002',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'medical_name' => 'Alexan',
                'unit' => 'Viên',
                'use' => 'Uống sau khi ăn',
                'quantity' => 5000,
                'import_price' => 700,
                'export_price' => 1200,
                'amount_day' => 1,
                'description' => 'Thuốc giảm đau.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_code' => 'MED00003',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'medical_name' => 'Pantenol',
                'unit' => 'Viên',
                'use' => 'Uống sau khi ăn',
                'quantity' => 5000,
                'import_price' => 10000,
                'export_price' => 12000,
                'amount_day' => 1,
                'description' => 'Loại thuốc da liễu trị bỏng hữu hiệu.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_code' => 'MED00004',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'medical_name' => 'Motilum M ',
                'unit' => 'Dạng xịt, bôi',
                'use' => 'Uống sau khi ăn',
                'quantity' => 5000,
                'import_price' => 500,
                'export_price' => 800,
                'amount_day' => 2,
                'description' => 'Dùng trong trường hợp đầy hơi, khó tiêu.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_code' => 'MED00006',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'medical_name' => 'Aspirin',
                'unit' => 'Viên',
                'use' => 'Uống sau khi ăn',
                'quantity' => 5000,
                'import_price' => 1000,
                'export_price' => 1200,
                'amount_day' => 2,
                'description' => 'Dùng trong trường hợp giảm đau.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_code' => 'MED00007',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'medical_name' => 'Penicillin',
                'unit' => 'Viên',
                'use' => 'Uống sau khi ăn',
                'quantity' => 5000,
                'import_price' => 1000,
                'export_price' => 1200,
                'amount_day' => 2,
                'description' => 'Thuốc kháng sinh',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_code' => 'MED00008',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'medical_name' => 'Ciprofloxacin',
                'unit' => 'Viên',
                'use' => 'Uống sau khi ăn',
                'quantity' => 5000,
                'import_price' => 1000,
                'export_price' => 1200,
                'amount_day' => 2,
                'description' => 'Thuốc kháng sinh',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_code' => 'MED00009',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'medical_name' => 'Calcium channel blockers',
                'unit' => 'Viên',
                'use' => 'Uống sau khi ăn',
                'quantity' => 5000,
                'import_price' => 1000,
                'export_price' => 1200,
                'amount_day' => 2,
                'description' => 'Thuốc tim mạch',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'medical_code' => 'MED00010',
                'department_id' => DoctorDepartment::inRandomOrder()->first()->id,
                'medical_name' => 'Erythromycin',
                'unit' => 'Viên',
                'use' => 'Uống sau khi ăn',
                'quantity' => 500,
                'import_price' => 800,
                'export_price' => 1200,
                'amount_day' => 2,
                'description' => 'Thuốc kháng sinh',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
