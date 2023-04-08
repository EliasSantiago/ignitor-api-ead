<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
  protected $model = Course::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'name'        => $this->faker->unique()->name(),
          'description' => $this->faker->sentence(20),
          'image'       => 'teste',
          'status'      => $this->faker->randomElement([1,2,3]),
          'slug'        => $this->faker->unique()->slug(),
          'price'       => $this->faker->randomFloat(2, 5, 150),
          'discount'    => $this->faker->numberBetween(0, 70),
          'start_date'  => $this->faker->dateTimeBetween('-1 years', 'now'),
          'end_date'    => $this->faker->dateTimeBetween('now', '+1 years'),
          'duration'    => $this->faker->numberBetween(1, 10),
          'created_at'  => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
