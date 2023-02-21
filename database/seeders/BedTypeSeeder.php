<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BedTypeSeeder extends Seeder
{
    protected $now;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        \App\Models\BedType::insert([
            [
                'name' => 'VIP',
                'description' => "That is vip ",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Medium quality',
                'description' => "quality normal",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Low quality',
                'description' => "Low quality",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Single bed',
                'description' => "102",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Double bed',
                'description' => "12",
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
