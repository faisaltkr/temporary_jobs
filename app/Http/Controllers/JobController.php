<?php
namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Fetch all jobs
    public function index()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }

    // Create a new job
    public function store(Request $request)
    {
        $request->validate([
            'job_name' => 'required|string|max:255',
            'status' => 'required|in:open,closed',
        ]);

        $job = Job::create([
            'job_name' => $request->job_name,
            'status' => $request->status,
        ]);

        return response()->json($job, 201);
    }

    // Update an existing job
    public function update(Request $request, $id)
    {
        $request->validate([
            'job_name' => 'required|string|max:255',
            'status' => 'required|in:open,closed',
        ]);

        $job = Job::findOrFail($id);
        $job->update([
            'job_name' => $request->job_name,
            'status' => $request->status,
        ]);

        return response()->json($job);
    }

    // Delete a job
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return response()->json(null, 204);
    }
}
