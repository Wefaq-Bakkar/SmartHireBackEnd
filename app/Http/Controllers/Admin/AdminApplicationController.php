<?php
// app/Http/Controllers/Admin/AdminApplicationController.php
// app/Http/Controllers/Admin/AdminApplicationController.php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;


class AdminApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $applications = Application::filter($request->all())->paginate(10);
        return ApplicationResource::collection($applications);
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
    // app/Http/Controllers/Admin/AdminSeekerController.php
    public function update(UpdateApplicationRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $application = Application::findOrFail($id);
            $application->update($data);
            return response()->json($application);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $application = Application::findOrFail($id);
            $application->delete();
            return response()->json(['message' => 'Application deleted successfully']);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') { // Foreign key constraint violation
                return response()->json(['message' => 'The application is linked in another record and cannot be deleted'], 400);
            }
            return response()->json(['message' => 'An error occurred while deleting the application'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the application'], 500);
        }
    }

}