<?php

namespace Database\Factories;

use App\Models\Hire;
use App\Models\Offer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hire::class;



    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'offer_id' => Offer::factory(),
            'job_id' => Job::factory(),
            'seeker_id' => random_int(1,2),
            'specialist_id' => random_int(1,2),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->optional()->date(),
            'salary' => $this->faker->randomFloat(2, 1000, 10000),
            'employment_type' => $this->faker->randomElement(['full time', 'part time', 'contract', 'freelance', 'remote']),
        ];
    }
}