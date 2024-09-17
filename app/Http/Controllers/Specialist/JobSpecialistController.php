<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class JobSpecialistController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $jobs = Job::where('user_id', $user->id)->filter($request->all())->paginate(10);
        return JobResource::collection($jobs);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        try {
            $data = $request->validated();
            $job = Job::create($data);
            return new JobResource($job);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
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
    public function update(UpdateJobRequest $request, string $id)
    {
        $data = $request->validated();

        $job = Job::findOrFail($id);
        $job->update($data);

        return response()->json($job);
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
