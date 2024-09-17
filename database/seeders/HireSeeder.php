<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hire;

class HireSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Hire::factory(10)->create();
    }
}