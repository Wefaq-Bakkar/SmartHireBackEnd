<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $categories = ['Information Technology', 'Marketing', 'Finance', 'Healthcare', 'Education', 'Hospitality', 'Retail', 'Art', 'Engineering', 'Design'];

        return [
            'name' => $this->faker->randomElement($categories),
        ];
    }
}