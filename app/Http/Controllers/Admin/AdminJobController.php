<?php
// app/Http/Controllers/Admin/AdminJobController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jobs = Job::filter($request->all())->paginate(10);
        return JobResource::collection($jobs);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $data = $request->validated();

        $job = Job::create($data);

        return response()->json($job, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::findOrFail($id);
        return response()->json($job);
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
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return response()->json(['message' => 'Job deleted successfully']);
    }
}