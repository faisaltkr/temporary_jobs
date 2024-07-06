<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ScheduledVacancy;
use App\Models\User;
use App\Models\Vacancy;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduledVacancy>
 */
class ScheduledVacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = ScheduledVacancy::class;

    public function definition(): array
    {
        return [
            'vacancy_id' => Vacancy::factory(),
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['scheduled', 'canceled']),
        ];
    }
}
