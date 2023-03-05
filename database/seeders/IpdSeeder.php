<?php

namespace Database\Seeders;

use App\Models\Ipd;
use Illuminate\Database\Seeder;

class IpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ipd::factory()->count(50)->create();
    }
}
