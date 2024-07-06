<?php

namespace App\Http\Controllers;

use App\Mail\JobNotification;
use App\Models\Job;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class VacancyController extends Controller
{
    // Fetch all vacancies
    public function index()
    {
        return Inertia::render('Vacancies/Index', ['vacancies' => Vacancy::with('job')->get()]);
    }

    public function create()
    {
        return Inertia::render('Vacancies/Create', ['jobs' => Job::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

         $vacancy = Vacancy::create($request->all());

         //send email notification to all active users
        //we can make queue for this feature in background
        //seeded emails are fake so this feature will throw an error
        /*
         $activeUsersEmail = User::active()->pluck('email');
         foreach ($activeUsersEmail as $user) {
            Mail::to($user)->send(new JobNotification($vacancy));
         }
        */
        Mail::to("faizeltkr@gmail.com")->send(new JobNotification($vacancy));
        return Redirect::route('vacancies.index', ['message'=>'Success fully added']);
    }

    public function edit(Vacancy $vacancy)
    {
        return Inertia::render('Vacancies/Edit', ['vacancy' => $vacancy, 'jobs' =>Job::all() ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $vacancy = Vacancy::findOrFail($id);
        $vacancy->update($request->all());

        return Redirect::route('vacancies.index', ['message'=>'Success fully updated']);
    }

    public function destroy($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->delete();

        return response()->noContent();
    }
}
