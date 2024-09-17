<?php
// app/Http/Controllers/Admin/AdminHireController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHireRequest;
use App\Http\Requests\UpdateHireRequest;
use App\Http\Resources\HireResource;
use App\Models\Hire;
use Illuminate\Http\Request;

class AdminHireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $hires = Hire::filter($request->all())->paginate(10);
        return HireResource::collection($hires);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHireRequest $request)
    {
        $data = $request->validated();

        $hire = Hire::create($data);

        return response()->json($hire, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hire = Hire::findOrFail($id);
        return response()->json($hire);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHireRequest $request, string $id)
    {
        $data = $request->validated();

        $hire = Hire::findOrFail($id);
        $hire->update($data);

        return response()->json($hire);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hire = Hire::findOrFail($id);
        $hire->delete();

        return response()->json(['message' => 'Hire deleted successfully']);
    }
}