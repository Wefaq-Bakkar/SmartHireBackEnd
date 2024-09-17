<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        $jobTitles = ['Software Engineer', 'Marketing Manager', 'Financial Analyst', 'Nurse', 'Teacher', 'Hotel Manager'];
        $descriptions = ['Description 1', 'Description 2', 'Description 3', 'Description 4', 'Description 5'];
        $imageUrls = ['https://example.com/image1.jpg', 'https://example.com/image2.jpg', 'https://example.com/image3.jpg'];
        $types = ['full time', 'part time', 'contract', 'freelance', 'remote'];
        $countries = ['Country 1', 'Country 2', 'Country 3'];
        $statuses = ['draft', 'publish', 'closed'];

        return [
            'title' => $this->faker->randomElement($jobTitles),
            'description' => $this->faker->randomElement($descriptions),
            'salary' => $this->faker->numberBetween(20000, 100000),
            'city_id' => random_int(1,1), // Replace with your city ID range
            'category_id' => random_int(1, 1), // Replace with your category ID range
            'type' => $this->faker->randomElement($types),
            'country_id' => random_int(1, 10),
            'datePosted' => $this->faker->date(),
            'user_id' => random_int(1, 2), // Replace with your user ID range
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}