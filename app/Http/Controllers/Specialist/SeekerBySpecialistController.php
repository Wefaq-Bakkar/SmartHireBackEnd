<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeekerResource;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class SeekerBySpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $specialist = $request->user();

        // Get jobs posted by the current specialist
        $jobs = Job::where('user_id', $specialist->id)->pluck('id');

        // Get users who applied to those jobs with pagination
        $users = User::whereHas('seekerApplications', function ($query) use ($jobs, $specialist) {
            $query->whereIn('job_id', $jobs)
                ->where('specialist_id', $specialist->id);
        })->paginate(10); // Adjust the number 10 to the desired number of results per page

        return SeekerResource::collection($users);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
