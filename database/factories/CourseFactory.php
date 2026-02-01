<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        $startDate = now()->addDays(rand(1, 180));
        $endDate = (clone $startDate)->addDays(rand(1, 90));

        return [
            'name' => 'Course ' . $this->faker->unique()->numberBetween(1, 50),
            'description' => $this->faker->text(100),
            'hours' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 100, 10000),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'image' => $this->faker->word(),
        ];
    }
}
