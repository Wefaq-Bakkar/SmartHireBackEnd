<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Http\Resources\InterviewResource;
use App\Models\Interview;
use Illuminate\Http\Request;

class AdminInterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $interviews = Interview::filter($request->all())->paginate(10);
        return InterviewResource::collection($interviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInterviewRequest $request)
    {
        $data = $request->validated();

        $interview = Interview::create($data);

        return response()->json($interview, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $interview = Interview::findOrFail($id);
        return response()->json($interview);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterviewRequest $request, string $id)
    {
        $data = $request->validated();

        $interview = Interview::findOrFail($id);
        $interview->update($data);

        return response()->json($interview);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete();

        return response()->json(['message' => 'Interview deleted successfully']);
    }
}