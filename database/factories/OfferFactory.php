<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Job;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

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
            'status' => $this->faker->randomElement(['sent', 'accepted', 'rejected']),
            'salary' => $this->faker->randomFloat(2, 1000, 10000),
            'startdate' => $this->faker->date(),
            'expiredate' => $this->faker->date(),
            'employment_type' => $this->faker->randomElement(['full time', 'part time', 'contract', 'freelance', 'remote']),
        ];
    }
}