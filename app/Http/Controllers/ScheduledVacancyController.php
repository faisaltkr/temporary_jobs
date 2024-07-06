<?php

namespace App\Http\Controllers;

use App\Models\ScheduledVacancy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduledVacancyController extends Controller
{
    // Fetch all scheduled vacancies
    public function Calendar()
    {

        $vacancies = ScheduledVacancy::with(['vacancy.job', 'user'])->get();

        foreach($vacancies as $vac)
        {
            $calendarEvents[]=[
                "id"=> $vac->id,
                "title"=> $vac->vacancy->job->job_name,
                "start"=> $vac->vacancy->start_date,
                "end"=> $vac->vacancy->end_date,
                "description"=> $vac->vacancy->description,
                "status"=> $vac->status,
            ];
        }

        return Inertia::render('WeeklyCalendar/Index',['calendarEvents' => $calendarEvents]);
    }
    public function index()
    {
        return ScheduledVacancy::with('vacancy.job', 'user')->get();
    }

    public function create()
    {
        return Inertia::render('WeeklyCalendar/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:scheduled,canceled',
        ]);

        return ScheduledVacancy::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:scheduled,canceled',
        ]);

        $scheduledVacancy = ScheduledVacancy::findOrFail($id);
        $scheduledVacancy->update($request->all());

        return $scheduledVacancy;
    }

    public function destroy($id)
    {
        $scheduledVacancy = ScheduledVacancy::findOrFail($id);
        $scheduledVacancy->delete();

        return response()->noContent();
    }
}
