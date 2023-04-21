<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
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
        \App\Models\Service::insert([
            [
                'service_code' => 'SEV00001',
                'service_name' => 'Chụp X-quang',
                'all_price' => 200000,
                'discount' => 10,
                'description' => 'Đây là một kỹ thuật chụp ảnh sử dụng tia X để tạo ra hình ảnh của các cơ quan và xương trong cơ thể. Chụp X-quang thường được sử dụng để phát hiện các vấn đề liên quan đến xương, phổi, tim và các cơ quan khác.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'service_code' => 'SEV00002',
                'service_name' => 'Siêu âm',
                'all_price' => 300000,
                'discount' => 10,
                'description' => 'Đây là một phương pháp sử dụng sóng âm để tạo ra hình ảnh của các cơ quan và mô trong cơ thể. Siêu âm thường được sử dụng để xác định tình trạng của thai nhi trong bụng mẹ, hoặc để chẩn đoán các vấn đề liên quan đến gan, thận, mật, tim, v.v.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'service_code' => 'SEV00003',
                'service_name' => 'MRI',
                'all_price' => 500000,
                'discount' => 10,
                'description' => 'MRI là viết tắt của Magnetic Resonance Imaging, là một phương pháp chẩn đoán hình ảnh sử dụng từ trường và sóng radio để tạo ra hình ảnh của các cơ quan và mô trong cơ thể. MRI thường được sử dụng để xác định các vấn đề liên quan đến não, tủy sống, khớp, v.v.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'service_code' => 'SEV00004',
                'service_name' => 'Xét nghiệm máu',
                'all_price' => 600000,
                'discount' => 10,
                'description' => 'Đây là một phương pháp đo lượng các chất hóa học trong máu để xác định tình trạng sức khỏe của bệnh nhân. Xét nghiệm máu thường được sử dụng để phát hiện các vấn đề liên quan đến đường huyết, men gan, thận, v.v.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'service_code' => 'SEV00005',
                'service_name' => 'Xét nghiệm nước tiểu',
                'all_price' => 1000000,
                'discount' => 10,
                'description' => ' Đây là một phương pháp đo lượng các chất hóa học trong nước tiểu để xác định tình trạng sức khỏe của bệnh nhân. Xét nghiệm nước tiểu thường được sử dụng để phát hiện các vấn đề liên quan đến thận, đường tiết niệu, v.v.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
