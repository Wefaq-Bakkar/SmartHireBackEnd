<?php

namespace Database\Factories;

use App\Models\Interview;
use App\Models\Application;
use App\Models\Job;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

class InterviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'application_id' =>  Application::factory(),
            'job_id' => Job::factory(),
            'seeker_id' => random_int(1,2),
            'specialist_id' => random_int(1,2),

            'date_from' => $this->faker->dateTimeBetween('now', '+1 week'),
            'date_to' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'location' => $this->faker->address,
            'status' => $this->faker->randomElement(['strong-hire', 'wait-list', 'short-list', 'rejected']),
        ];
    }
}