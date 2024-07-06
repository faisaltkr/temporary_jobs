<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ScheduledVacancy;

class DeletePastScheduledVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-past-scheduled-vacancies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ScheduledVacancy::where('end_date', '<', now())->delete();
    }
}
