<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    protected $model = Lesson::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'module_id'   => Module::factory(),
            'name'        => $this->faker->sentence,
            'url'         => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'video'       => $this->faker->slug,
            'duration'    => $this->faker->time('H:i:s'),
            'free'        => $this->faker->boolean,
            'status'      => $this->faker->randomElement(['draft', 'published']),
        ];
    }
}
