<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition(): array
    {
        return [
            'name' => 'Lesson ' . $this->faker->numberBetween(1, 50),
            'description' => $this->faker->text(),
            'video' => $this->faker->optional()->word(),
            'hours' => $this->faker->numberBetween(1, 4),
            'course_id' => Course::factory(),
        ];
    }
}
