<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationSpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return ApplicationResource::collection(Application::where('specialist_id', $user->id)->filter($request->all())->paginate(10));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicationRequest $request)
    {
        $data = $request->validated();

        $application = Application::create($data);

        return response()->json($application, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $application = Application::findOrFail($id);
        return new ApplicationResource($application);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, string $id)
    {
        $data = $request->validated();

        $application = Application::findOrFail($id);
        $application->update($data);

        return response()->json($application);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
