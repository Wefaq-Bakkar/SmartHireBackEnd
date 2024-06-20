<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index (Request $request)
    {
        $user = $request->user();
        return JobResource::collection(Job::where('user_id', $user->id)->paginate(10));
    }
    public function indexForGuest(Request $request)
    {
        $jobs = Job::paginate(10);
        return JobResource::collection($jobs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $data=$request->validated();
        $job= Job::create($data);
        return new JobResource($job);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job,Request $request)
    {
        $user = $request->user();
        if($user->id !== $job->user_id){
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return new JobResource($job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $data = $request->validated();
        if ($job->update($data)) {
            return new JobResource($job);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Job $job)
    {
        $user = $request->user();
        if($user->id !== $job->user_id){
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        if ($job->delete()) {
            return response()->json(['message' => 'Deleted successfully']);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
