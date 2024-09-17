<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHireRequest;
use App\Http\Requests\UpdateHireRequest;
use App\Http\Resources\HireResource;
use App\Models\Hire;
use Illuminate\Http\Request;

class HireSpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return HireResource::collection(Hire::where('specialist_id', $user->id)->filter($request->all())->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHireRequest $request)
    {
        try {
            $data = $request->validated();
            $hire = Hire::create($data);
            return new HireResource($hire);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $hire = Hire::find($id);
        $user = $request->user();
        if ($user->id !== $hire->specialist_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return new HireResource($hire);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHireRequest $request, $id)
    {
        try {
            $hire = Hire::find($id);
            $data = $request->validated();
            $hire->update($data);
            return new HireResource($hire);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $hire = Hire::find($id);
            $hire->delete();
            return response()->json(['message' => 'Hire deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}