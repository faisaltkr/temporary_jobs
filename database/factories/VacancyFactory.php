<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Vacancy::class;

    public function definition(): array
    {
        return [
            'job_id' => Job::factory(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
