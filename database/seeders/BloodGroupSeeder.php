<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
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
        \App\Models\BloodGroup::insert([
            [
                'name' => 'A+',
                'remained_bags' => 12,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'B+',
                'remained_bags' => 25,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'O+',
                'remained_bags' => 44,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'AB+',
                'remained_bags' => 102,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'A-',
                'remained_bags' => 12,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'B-',
                'remained_bags' => 32,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'C-',
                'remained_bags' => 22,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'D-',
                'remained_bags' => 24,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
