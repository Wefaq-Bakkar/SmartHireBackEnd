<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Hire;
use App\Models\Interview;
use App\Models\Offer;
use Database\Factories\ApplicationFactory;
use Database\Factories\HireFactory;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\City;
use App\Models\Category;
use App\Models\Job;
use App\Models\Application;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Country::factory()->count(10)->create();

        City::factory()->count(50)->create();

        Category::factory()->count(20)->create();


        Job::factory()->count(50)->create();







        Application::factory()->count(50)->create();



        Interview::factory()->count(10)->create();

        Offer::factory()->count(10)->create();

        Hire::factory()->count(50)->create();


    }
}
