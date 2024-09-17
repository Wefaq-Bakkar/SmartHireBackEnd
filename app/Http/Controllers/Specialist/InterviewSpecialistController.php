<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Http\Resources\InterviewResource;
use App\Models\Interview;
use Illuminate\Http\Request;

//php artisan make:resource InterviewResource
class InterviewSpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return InterviewResource::collection(Interview::where('specialist_id', $user->id)->filter($request->all())->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInterviewRequest $request)
    {
        try {
            $data = $request->validated();
            $interview = Interview::create($data);
            return new InterviewResource($interview);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id,Request $request)
    {
        $interview=Interview::find($id);
        $user = $request->user();
        if($user->id !== $interview->specialist_id){
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return new InterviewResource($interview);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterviewRequest $request,$id)
    {
        try
        {
            $interview=Interview::find($id);
            $data = $request->validated();
            $interview->update($data);
            return new InterviewResource($interview);
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try
        {
            $interview=Interview::find($id);
            $interview->delete();
            return response()->json(['message' => 'Interview deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
