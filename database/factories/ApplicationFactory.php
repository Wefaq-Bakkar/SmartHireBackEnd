<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;
use App\Models\user;
use App\Models\Application;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statuses = [
            'screening',
            'in-review',
            'interview-scheduled',
            'on-hold',
            'rejected',
            'offered',
            'offer-accepted',
            'offer-declined',
            'hired',
        ];

        return [
            'job_id' => Job::factory(),
            'seeker_id' => random_int(1,2),
            'specialist_id' => random_int(1,2),
            'application_status' => $this->faker->randomElement($statuses),
        ];}
}
