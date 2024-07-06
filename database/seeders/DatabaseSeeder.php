<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\ScheduledVacancy;
use App\Models\User;
use App\Models\Vacancy;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(50)->create();
         Job::factory(50)->create();
         Vacancy::factory(50)->create();
         ScheduledVacancy::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
